<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SpllierlistController extends Controller
{
    public function supplier_list(Request $request)
    {
        $search = $request->query('search');

        $suppliers = Suppliers::withCount('purchases')
            ->withSum('purchases', 'total_amount')
            ->withSum('purchases', 'balance_amount')
            ->with(['purchases' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('list.supplier_list', compact('suppliers', 'search'));
    }

    // Update Supplier (Edit Modal)
    public function update(Request $request, Suppliers $supplier)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\x{0A80}-\x{0AFF}A-Za-z\s]+$/u',
            ],
            'address' => [
                'required',
                'string',
                'max:1000',
            ],
        ], [
            'name.required' => 'સપ્લાયરનું નામ દાખલ કરો.',
            'name.max' => 'સપ્લાયરનું નામ ખૂબ લાંબું છે.',
            'name.regex' => 'સપ્લાયરનું નામમાં માત્ર અક્ષરો અને સ્પેસ હોવા જોઈએ.',
            'address.required' => 'સરનામું દાખલ કરો.',
            'address.max' => 'સરનામું ખૂબ લાંબું છે.',
        ]);

        try {

            $supplier->update($validated);

            return response()->json([
                'status'   => true,
                'message'  => 'સપ્લાયર સફળતાપૂર્વક અપડેટ થયો.',
                'supplier' => $supplier,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'સપ્લાયર અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);
        }
    }

    // Delete Supplier
    public function destroy(Suppliers $supplier)
    {
        try {

            $supplier->delete();

            return response()->json([
                'status'  => true,
                'message' => 'સપ્લાયર સફળતાપૂર્વક કાઢી નાખવામાં આવ્યો.',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'સપ્લાયર કાઢી નાખવામાં ભૂલ આવી.',
            ], 500);
        }
    }

    // View all purchases of one particular supplier
    public function supplierPurchases(Suppliers $supplier)
    {
        $purchases = $supplier->purchases()
            ->orderBy('created_at', 'desc')
            ->get();

        $purchaseIds = $purchases->pluck('id');

        // Sum of all still-pending check payments across this supplier's purchases.
        $pendingCheckTotal = PurchasePayment::whereIn('purchase_id', $purchaseIds)
            ->where('payment_method', 'check')
            ->where('status', 'pending')
            ->sum('amount');

        return view('list.supplier_purchases', compact('supplier', 'purchases', 'pendingCheckTotal'));
    }

    // (Pay Due) — cash/gpay apply immediately, check stays "baki" until passed.
    // A single physical check that covers MULTIPLE bills is still split into one
    // PurchasePayment row per bill (needed for correct paid/balance math per
    // purchase), but all those rows share one "check_group_id" so the Check
    // List page can display them as ONE row with the full amount and all bill
    // numbers together, instead of one row per bill.
    public function payDue(Request $request)
    {
        $validated = $request->validate([
            'supplier_id'     => 'required|exists:suppliers,id',
            'paid_amount'     => 'required|numeric|min:0.01',
            'payment_method'  => 'nullable|in:cash,check,gpay',
            'check_number'    => 'required_if:payment_method,check|nullable|string|max:50',
            'check_date'      => 'required_if:payment_method,check|nullable|date',
        ], [
            'check_number.required_if' => 'ચેક નંબર દાખલ કરો.',
            'check_date.required_if'   => 'ચેક તારીખ પસંદ કરો.',
        ]);

        $supplierId    = $validated['supplier_id'];
        $paidAmount    = floatval($validated['paid_amount']);
        $paymentMethod = $validated['payment_method'] ?? 'cash';
        $checkNumber   = $validated['check_number'] ?? null;
        $checkDate     = $validated['check_date'] ?? null;

        $supplier = Suppliers::findOrFail($supplierId);

        $purchases = $supplier->purchases()
            ->where('balance_amount', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        $totalBalanceDue = $purchases->sum('balance_amount');

        // Exclude amounts already committed to pending checks from what's payable.
        $pendingCheckTotal = PurchasePayment::whereIn('purchase_id', $purchases->pluck('id'))
            ->where('payment_method', 'check')
            ->where('status', 'pending')
            ->sum('amount');

        $payableNow = max($totalBalanceDue - $pendingCheckTotal, 0);

        if ($paidAmount > $payableNow) {
            return response()->json([
                'success' => false,
                'message' => $pendingCheckTotal > 0
                    ? 'ચૂકવણી રકમ ચૂકવવાપાત્ર રકમ (₹' . number_format($payableNow, 2) . ') કરતાં વધુ હોઈ શકે નહીં. ₹' . number_format($pendingCheckTotal, 2) . ' ચેક દ્વારા પેન્ડિંગ છે.'
                    : 'ચૂકવણી રકમ કુલ બાકી રકમ કરતાં વધુ હોઈ શકે નહીં.',
            ], 422);
        }

        $remainingPaid = $paidAmount;

        // One shared id per physical check — same value on every row created
        // below, so the Check List page can merge them into a single entry.
        $checkGroupId = $paymentMethod === 'check' ? (string) Str::uuid() : null;

        DB::transaction(function () use ($purchases, &$remainingPaid, $paymentMethod, $checkNumber, $checkDate, $checkGroupId) {

            foreach ($purchases as $purchase) {

                if ($remainingPaid <= 0) {
                    break;
                }

                $allocated = min($remainingPaid, $purchase->balance_amount);
                $remainingPaid -= $allocated;

                if ($paymentMethod === 'check') {

                    // Just record it as a pending check — balance is untouched
                    // until passed. check_group_id ties this row to the same
                    // physical check as the other bills it was applied to.
                    PurchasePayment::create([
                        'purchase_id'     => $purchase->id,
                        'payment_method'  => 'check',
                        'amount'          => $allocated,
                        'check_number'    => $checkNumber,
                        'check_date'      => $checkDate,
                        'check_group_id'  => $checkGroupId,
                        'status'          => 'pending',
                        'created_by'      => session('admin_id'),
                    ]);

                } else {

                    // cash / gpay -> apply immediately
                    $purchase->paid_amount    += $allocated;
                    $purchase->balance_amount -= $allocated;
                    $purchase->save();

                    PurchasePayment::create([
                        'purchase_id'    => $purchase->id,
                        'payment_method' => $paymentMethod,
                        'amount'         => $allocated,
                        'status'         => 'passed',
                        'created_by'     => session('admin_id'),
                    ]);
                }
            }
        });

        $newRemainingDue = $supplier->purchases()->sum('balance_amount');

        $newPendingCheckTotal = PurchasePayment::whereIn('purchase_id', $supplier->purchases()->pluck('id'))
            ->where('payment_method', 'check')
            ->where('status', 'pending')
            ->sum('amount');

        $message = $paymentMethod === 'check'
            ? 'ચેક ચુકવણી નોંધાઈ ગઈ છે. ચેક પાસ થયા પછી બાકી રકમ અપડેટ થશે.'
            : 'બાકી રકમ સફળતાપૂર્વક જમા થઈ ગઈ છે.';

        return response()->json([
            'success'             => true,
            'message'             => $message,
            'remaining_due'       => $newRemainingDue,
            'pending_check_total' => $newPendingCheckTotal,
            'payment_method'      => $paymentMethod,
        ]);
    }
}
