<?php

namespace App\Http\Controllers;

use App\Models\PurchasePayment;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class CheckController extends Controller
{
    // Check List Page (with filters)
    //
    // A single physical check can be split across several purchases/bills
    // (e.g. paid from the supplier "baki jama karo" modal). Those rows all
    // share the same check_group_id. Here we GROUP them back into ONE
    // display row: total amount + all bill numbers together, instead of
    // showing one row per bill with the same check number repeated.
    public function index(Request $request)
    {
        $date         = $request->query('date');
        $checkNumber  = $request->query('check_number');
        $supplierId   = $request->query('supplier_id');

        $rows = PurchasePayment::with('purchase.supplier')
            ->where('payment_method', 'check')
            ->when($date, function ($query) use ($date) {
                $query->whereDate('check_date', $date);
            })
            ->when($checkNumber, function ($query) use ($checkNumber) {
                $query->where(function ($q) use ($checkNumber) {
                    $q->where('check_number', 'like', "%{$checkNumber}%")
                      ->orWhereHas('purchase', function ($pq) use ($checkNumber) {
                          $pq->where('billing_no', 'like', "%{$checkNumber}%");
                      });
                });
            })
            ->when($supplierId, function ($query) use ($supplierId) {
                $query->whereHas('purchase', function ($pq) use ($supplierId) {
                    $pq->where('supplier_id', $supplierId);
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        // Merge rows that belong to the same physical check.
        // Rows with no check_group_id (single-purchase checks created
        // during purchase entry) are their own group of one.
        $grouped = $rows->groupBy(function ($payment) {
            return $payment->check_group_id ?: 'single-' . $payment->id;
        })->map(function ($group) {

            $first = $group->first();

            return (object) [
                'group_key'     => $first->check_group_id ?: 'single-' . $first->id,
                'payment_ids'   => $group->pluck('id')->values()->all(),
                'check_number'  => $first->check_number,
                'check_date'    => $first->check_date,
                'amount'        => $group->sum('amount'),
                'status'        => $first->status,
                'supplier_name' => $first->purchase->supplier->name ?? '-',
                'billing_nos'   => $group->pluck('purchase.billing_no')->filter()->unique()->implode(', '),
            ];
        })->values();

        // Grouping happens in PHP, so paginate the grouped collection manually
        // (keeps the same pagination UI/behaviour the blade already expects).
        $perPage     = 10;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;

        $checks = new LengthAwarePaginator(
            $grouped->forPage($currentPage, $perPage)->values(),
            $grouped->count(),
            $perPage,
            $currentPage,
            [
                'path'  => Paginator::resolveCurrentPath(),
                'query' => $request->query(),
            ]
        );

        $suppliers = Suppliers::orderBy('name')->get();

        return view('check.check_list', compact('checks', 'suppliers', 'date', 'checkNumber', 'supplierId'));
    }

    // Update check status: pass / bounce / cancel — for ONE OR MORE payment
    // rows at once (a "group" that represents a single physical check split
    // across several bills, or a single row for a normal check).
    //
    // - "passed"    -> blocked until check_date is today or earlier.
    // - "bounced"   -> blocked until check_date is today or earlier.
    // - "cancelled" -> ALWAYS allowed, regardless of date.
    //
    // When a "pending" row is marked "passed", its linked purchase's
    // paid_amount / balance_amount are updated — this is the ONLY place a
    // check payment's amount is ever applied to a purchase.
    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'payment_ids'   => ['required', 'array', 'min:1'],
            'payment_ids.*' => ['integer', 'exists:purchase_payments,id'],
            'status'        => ['required', 'in:passed,bounced,cancelled'],
        ]);

        $payments = PurchasePayment::with('purchase')
            ->whereIn('id', $validated['payment_ids'])
            ->where('payment_method', 'check')
            ->get();

        if ($payments->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'ચેક મળ્યો નથી.',
            ], 404);
        }

        // Server-side guard: block "passed" AND "bounced" until every row's
        // own check date has arrived (today or already passed).
        if (in_array($validated['status'], ['passed', 'bounced'], true)) {

            foreach ($payments as $payment) {

                $checkDate = $payment->check_date ? Carbon::parse($payment->check_date)->startOfDay() : null;

                if (!$checkDate || $checkDate->gt(Carbon::today())) {

                    $actionLabel = $validated['status'] === 'passed' ? 'ચેક પાસ' : 'ચેક બાઉન્સ';

                    return response()->json([
                        'status'  => false,
                        'message' => 'ચેકની તારીખ ' . ($checkDate ? $checkDate->format('d-m-Y') : '') . ' સુધી "' . $actionLabel . '" કરી શકાશે નહીં. ત્યાં સુધી ફક્ત "રદ કરો" જ શક્ય છે.',
                        'reason'  => 'check_date_not_due',
                    ], 422);
                }
            }
        }

        try {

            DB::transaction(function () use ($payments, $validated) {

                foreach ($payments as $payment) {

                    // Only move money the first time a pending row is passed.
                    if ($validated['status'] === 'passed' && $payment->status === 'pending') {

                        $purchase = $payment->purchase;

                        if ($purchase) {
                            $newPaid    = $purchase->paid_amount + $payment->amount;
                            $newBalance = max($purchase->total_amount - $newPaid, 0);

                            $purchase->update([
                                'paid_amount'    => $newPaid,
                                'balance_amount' => $newBalance,
                            ]);
                        }
                    }

                    // Bounced / Cancelled: nothing was ever deducted, so
                    // there is nothing to reverse — just record status.
                    $payment->update([
                        'status' => $validated['status'],
                    ]);
                }
            });

            $labels = [
                'passed'    => 'ચેક પાસ થયો. ચૂકવેલ / બાકી રકમ અપડેટ થઈ ગઈ છે.',
                'bounced'   => 'ચેક બાઉન્સ થયો.',
                'cancelled' => 'ચેક રદ કરવામાં આવ્યો.',
            ];

            return response()->json([
                'status'     => true,
                'message'    => $labels[$validated['status']],
                'new_status' => $validated['status'],
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'સ્થિતિ અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);

        }
    }
}
