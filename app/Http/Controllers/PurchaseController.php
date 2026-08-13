<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_no'             => ['required', 'string', 'max:50', 'unique:purchases,billing_no'],
            'invoice_date' => ['required', 'date'],
            'supplier_id'            => ['required', 'exists:suppliers,id'],
            'paid_amount'            => ['required', 'numeric', 'min:0'],
            'items'                  => ['required', 'array', 'min:1'],
            'items.*.product_name'   => ['required', 'string', 'max:255'],
            'items.*.qty'            => ['required', 'numeric', 'min:0.01'],
            'items.*.prakar'         => ['required', 'string', 'max:30'],
            'items.*.prakar_text'    => ['required', 'string', 'max:50'],
            'items.*.rate'           => ['required', 'numeric', 'min:0'],
        ], [
            'billing_no.required'     => 'કૃપા કરીને બિલ નંબર દાખલ કરો.',
            'billing_no.unique'       => 'આ બિલ નંબર પહેલેથી ઉપયોગમાં લેવાયેલ છે.',
            'supplier_id.required'    => 'કૃપા કરીને સપ્લાયર પસંદ કરો.',
            'items.required'          => 'ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.',
            'items.*.prakar.required' => 'કૃપા કરીને પ્રકાર પસંદ કરો.',
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
}
