<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Add Product Page
    public function add_product()
    {
        $suppliers = Suppliers::orderBy('id', 'DESC')->get();

        return view('product.add_new_product', compact('suppliers'));
    }


    // Store Supplier
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\s]+$/u',
            ],

            // ONLY 10 DIGITS + MUST BE UNIQUE
            'mobile' => [
                'required',
                'digits:10',
                'unique:suppliers,mobile',
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

            'mobile.required' => 'મોબાઇલ નંબર દાખલ કરો.',
            'mobile.digits' => 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.',
            'mobile.unique' => 'આ મોબાઇલ નંબર પહેલેથી નોંધાયેલ છે.',

            'address.required' => 'સરનામું દાખલ કરો.',
            'address.max' => 'સરનામું ખૂબ લાંબું છે.',
        ]);


        $supplier = Suppliers::create([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'address' => $validated['address'],
        ]);


        return response()->json([
            'status' => true,
            'message' => 'સપ્લાયર સફળતાપૂર્વક ઉમેરાયો.',
            'supplier' => $supplier,
        ]);
    }
}
