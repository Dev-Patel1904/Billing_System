<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpllierlistController extends Controller
{
    // Page Show — with purchase aggregates per supplier, search + status filter + pagination
    public function supplier_list(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $suppliers = Suppliers::withCount('purchases')
            ->withSum('purchases', 'total_amount')
            ->withSum('purchases', 'balance_amount')
            ->with(['purchases' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('list.supplier_list', compact('suppliers', 'search', 'status'));
    }


    // Update Supplier (Edit Modal)
    public function update(Request $request, Suppliers $supplier)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\s]+$/u',
            ],

            'mobile' => [
                'required',
                'digits:10',
                Rule::unique('suppliers', 'mobile')->ignore($supplier->id),
            ],

            'address' => [
                'required',
                'string',
                'max:1000',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ], [
            'name.required' => 'સપ્લાયરનું નામ દાખલ કરો.',
            'name.max' => 'સપ્લાયરનું નામ ખૂબ લાંબું છે.',
            'name.regex' => 'સપ્લાયરનું નામમાં માત્ર અક્ષરો અને સ્પેસ હોવા જોઈએ.',

            'mobile.required' => 'મોબાઇલ નંબર દાખલ કરો.',
            'mobile.digits' => 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.',
            'mobile.unique' => 'આ મોબાઇલ નંબર પહેલેથી નોંધાયેલ છે.',

            'address.required' => 'સરનામું દાખલ કરો.',
            'address.max' => 'સરનામું ખૂબ લાંબું છે.',

            'status.required' => 'સ્થિતિ પસંદ કરો.',
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
}
