<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
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

        return view('list.supplier_purchases', compact('supplier', 'purchases'));
    }

    //(Pay Due)
    public function payDue(Request $request)
    {
        $request->validate([
            'supplier_id'     => 'required|exists:suppliers,id',
            'paid_amount'     => 'required|numeric|min:0.01',
            'payment_method'  => 'nullable|in:cash,check,gpay',
            'check_number'    => 'nullable|string|max:50',
        ]);

        $supplierId = $request->input('supplier_id');
        $paidAmount = floatval($request->input('paid_amount'));

        $supplier = Suppliers::findOrFail($supplierId);

        $purchases = $supplier->purchases()
            ->where('balance_amount', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        $totalBalanceDue = $purchases->sum('balance_amount');

        if ($paidAmount > $totalBalanceDue) {
            return response()->json([
                'success' => false,
                'message' => 'ચૂકવણી રકમ કુલ બાકી રકમ કરતાં વધુ હોઈ શકે નહીં.',
            ], 422);
        }

        $remainingPaid = $paidAmount;

        foreach ($purchases as $purchase) {
            if ($remainingPaid <= 0) {
                break;
            }

            if ($remainingPaid >= $purchase->balance_amount) {
                $remainingPaid -= $purchase->balance_amount;
                $purchase->paid_amount += $purchase->balance_amount;
                $purchase->balance_amount = 0;
                $purchase->save();
            } else {
                $purchase->balance_amount -= $remainingPaid;
                $purchase->paid_amount += $remainingPaid;
                $purchase->save();
                $remainingPaid = 0;
            }
        }

        $newRemainingDue = $supplier->purchases()->sum('balance_amount');

        return response()->json([
            'success' => true,
            'message' => 'બાકી રકમ સફળતાપૂર્વક જમા થઈ ગઈ છે.',
            'remaining_due' => $newRemainingDue,
        ]);
    }
}
