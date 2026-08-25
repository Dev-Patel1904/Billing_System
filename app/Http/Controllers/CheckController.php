<?php

namespace App\Http\Controllers;

use App\Models\PurchasePayment;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckController extends Controller
{
    // Check List Page (with filters)
    public function index(Request $request)
    {
        $date         = $request->query('date');
        $checkNumber  = $request->query('check_number');
        $supplierId   = $request->query('supplier_id');

        $checks = PurchasePayment::with('purchase.supplier')
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
            ->paginate(10)
            ->withQueryString();

        $suppliers = Suppliers::orderBy('name')->get();

        return view('check.check_list', compact('checks', 'suppliers', 'date', 'checkNumber', 'supplierId'));
    }

    // Update check status: pass / bounce / cancel
    // Only "passed" is gated by check_date (must be today or earlier).
    // "bounced" and "cancelled" are always allowed regardless of date.
    // When a "pending" check is marked "passed", the linked purchase's
    // paid_amount / balance_amount are updated here — this is the ONLY
    // place a check payment's amount is ever applied to the purchase.
    public function updateStatus(Request $request, PurchasePayment $payment)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:passed,bounced,cancelled'],
        ]);

        // Server-side guard: block ONLY "passed" until the check's own
        // date has arrived (today or already passed). Bounce/cancel skip this.
        if ($validated['status'] === 'passed') {

            $checkDate = $payment->check_date ? Carbon::parse($payment->check_date)->startOfDay() : null;

            if (!$checkDate || $checkDate->gt(Carbon::today())) {
                return response()->json([
                    'status'  => false,
                    'message' => 'ચેકની તારીખ ' . ($checkDate ? $checkDate->format('d-m-Y') : '') . ' સુધી "ચેક પાસ" કરી શકાશે નહીં.',
                    'reason'  => 'check_date_not_due',
                ], 422);
            }
        }

        try {

            DB::transaction(function () use ($payment, $validated) {

                // Only move money the first time a pending check is passed.
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

                // Bounced / Cancelled: nothing was ever deducted from the
                // purchase, so there is nothing to reverse — just record status.
                $payment->update([
                    'status' => $validated['status'],
                ]);
            });

            $labels = [
                'passed'    => 'ચેક પાસ થયો. ચૂકવેલ / બાકી રકમ અપડેટ થઈ ગઈ છે.',
                'bounced'   => 'ચેક બાઉન્સ થયો.',
                'cancelled' => 'ચેક રદ કરવામાં આવ્યો.',
            ];

            return response()->json([
                'status'      => true,
                'message'     => $labels[$validated['status']],
                'new_status'  => $validated['status'],
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'સ્થિતિ અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);

        }
    }
}
