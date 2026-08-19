<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PurchasePayment;

class PurchaseController extends Controller
{
    // Purchase List Page
    public function index()
    {
        $purchases = Purchase::with('supplier')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('purchase.purchase', compact('purchases'));
    }


    // Purchase Detail Page
    public function purchase_detail(Purchase $purchase)
    {
        $purchase->load('items', 'supplier');

        return view('purchase.purchase_detail', compact('purchase'));
    }


    // Purchase PDF / Print Page
    public function pdf(Purchase $purchase)
    {
        $purchase->load('items', 'supplier');

        return view('purchase.pdf', compact('purchase'));
    }


    // Update Payment
    public function updatePayment(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:' . $purchase->balance_amount,
            ],
        ], [
            'amount.required' => 'રકમ દાખલ કરો.',
            'amount.numeric'  => 'રકમ યોગ્ય નંબર હોવી જોઈએ.',
            'amount.min'      => 'રકમ 0 કરતાં વધુ હોવી જોઈએ.',
            'amount.max'      => 'બાકી રકમ કરતાં વધુ ચૂકવી શકાય નહીં.',
        ]);

        try {

            $amount  = $validated['amount'];
            $paid    = $purchase->paid_amount + $amount;
            $balance = max($purchase->total_amount - $paid, 0);

            $purchase->update([
                'paid_amount'    => $paid,
                'balance_amount' => $balance,
            ]);

            return response()->json([
                'status'         => true,
                'message'        => 'ચુકવણી સફળતાપૂર્વક અપડેટ થઈ.',
                'paid_amount'    => $paid,
                'balance_amount' => $balance,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'ચુકવણી અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);
        }
    }


    // Delete Purchase
    public function destroy(Purchase $purchase)
    {
        try {

            $purchase->delete();

            return response()->json([
                'status'  => true,
                'message' => 'ખરીદી સફળતાપૂર્વક કાઢી નાખવામાં આવી.',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'ખરીદી કાઢી નાખવામાં ભૂલ આવી.',
            ], 500);
        }
    }


    // Save purchase header + all product lines in one go
    // Save purchase header + all product lines in one go
public function store(Request $request)
{
    $validated = $request->validate([
        'billing_no'             => ['required', 'string', 'max:50', 'unique:purchases,billing_no'],
        'invoice_date'           => ['required', 'date'],
        'supplier_id'            => ['required', 'exists:suppliers,id'],
        'paid_amount'            => ['required', 'numeric', 'min:0'],
        'payment_method'         => ['nullable', 'in:cash,check,gpay'],
        'check_number'           => ['required_if:payment_method,check', 'nullable', 'string', 'max:50'],
        'check_date'             => ['required_if:payment_method,check', 'nullable', 'date'],
        'items'                  => ['required', 'array', 'min:1'],
        'items.*.product_name'   => ['required', 'string', 'max:255'],
        'items.*.qty'            => ['required', 'numeric', 'min:0.01'],
        'items.*.prakar'         => ['required', 'string', 'max:30'],
        'items.*.prakar_text'    => ['required', 'string', 'max:50'],
        'items.*.rate'           => ['required', 'numeric', 'min:0'],
    ], [
        'billing_no.required'      => 'કૃપા કરીને બિલ નંબર દાખલ કરો.',
        'billing_no.unique'        => 'આ બિલ નંબર પહેલેથી ઉપયોગમાં લેવાયેલ છે.',
        'invoice_date.required'    => 'કૃપા કરીને બિલ તારીખ પસંદ કરો.',
        'supplier_id.required'     => 'કૃપા કરીને સપ્લાયર પસંદ કરો.',
        'items.required'           => 'ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.',
        'items.*.prakar.required'  => 'કૃપા કરીને પ્રકાર પસંદ કરો.',
        'check_number.required_if' => 'ચેક નંબર દાખલ કરો.',
        'check_date.required_if'   => 'ચેક તારીખ પસંદ કરો.',
    ]);

    $totalQty    = 0;
    $totalAmount = 0;

    foreach ($validated['items'] as $item) {
        $totalQty    += $item['qty'];
        $totalAmount += $item['qty'] * $item['rate'];
    }

    $paid    = $validated['paid_amount'];
    $balance = max($totalAmount - $paid, 0);

    try {
        $purchase = DB::transaction(function () use ($validated, $totalQty, $totalAmount, $paid, $balance) {

            $purchase = Purchase::create([
                'billing_no'     => $validated['billing_no'],
                'invoice_date'   => $validated['invoice_date'],
                'supplier_id'    => $validated['supplier_id'],
                'total_qty'      => $totalQty,
                'total_amount'   => $totalAmount,
                'paid_amount'    => $paid,
                'balance_amount' => $balance,
                'created_by'     => session('admin_id'),
            ]);

            foreach ($validated['items'] as $item) {
                PurchaseItem::create([
                    'purchase_id'  => $purchase->id,
                    'product_name' => $item['product_name'],
                    'qty'          => $item['qty'],
                    'prakar'       => $item['prakar'],
                    'prakar_text'  => $item['prakar_text'],
                    'rate'         => $item['rate'],
                    'total'        => $item['qty'] * $item['rate'],
                ]);
            }

            // Record how the paid amount was actually paid (cash / check / gpay)
            if ($paid > 0) {
                PurchasePayment::create([
                    'purchase_id'    => $purchase->id,
                    'payment_method' => $validated['payment_method'] ?? 'cash',
                    'amount'         => $paid,
                    'check_number'   => $validated['check_number'] ?? null,
                    'check_date'     => $validated['check_date'] ?? null,
                    'created_by'     => session('admin_id'),
                ]);
            }

            return $purchase;
        });

        return response()->json([
            'status'   => true,
            'message'  => 'ખરીદી સફળતાપૂર્વક સચવાઈ.',
            'purchase' => $purchase->load('items', 'supplier'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status'  => false,
            'message' => 'ખરીદી સાચવવામાં ભૂલ આવી.',
        ], 500);
    }
}


    // Add a tracked payment (cash / check / gpay) to an existing purchase
public function addPayment(Request $request, Purchase $purchase)
{
    $validated = $request->validate([
        'payment_method' => ['required', 'in:cash,check,gpay'],
        'amount'         => ['required', 'numeric', 'min:0.01', 'max:' . $purchase->balance_amount],
        'check_number'   => ['required_if:payment_method,check', 'nullable', 'string', 'max:50'],
        'check_date'     => ['required_if:payment_method,check', 'nullable', 'date'],
    ], [
        'amount.required'       => 'રકમ દાખલ કરો.',
        'amount.max'            => 'બાકી રકમ કરતાં વધુ ચૂકવી શકાય નહીં.',
        'check_number.required_if' => 'ચેક નંબર દાખલ કરો.',
        'check_date.required_if'   => 'ચેક તારીખ પસંદ કરો.',
    ]);

    try {

        $purchase = DB::transaction(function () use ($validated, $purchase) {

            // Record the individual payment
            PurchasePayment::create([
                'purchase_id'    => $purchase->id,
                'payment_method' => $validated['payment_method'],
                'amount'         => $validated['amount'],
                'check_number'   => $validated['check_number'] ?? null,
                'check_date'     => $validated['check_date'] ?? null,
                'created_by'     => session('admin_id'),
            ]);

            // Update running totals on the purchase itself
            $newPaid    = $purchase->paid_amount + $validated['amount'];
            $newBalance = max($purchase->total_amount - $newPaid, 0);

            $purchase->update([
                'paid_amount'    => $newPaid,
                'balance_amount' => $newBalance,
            ]);

            return $purchase->fresh();
        });

        return response()->json([
            'status'         => true,
            'message'        => 'ચુકવણી સફળતાપૂર્વક ઉમેરાઈ.',
            'paid_amount'    => (float) $purchase->paid_amount,
            'balance_amount' => (float) $purchase->balance_amount,
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status'  => false,
            'message' => 'ચુકવણી ઉમેરવામાં ભૂલ આવી.',
        ], 500);

    }
}


}
