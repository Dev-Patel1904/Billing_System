<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Models\Type;

class SupplierController extends Controller
{
    // Add Product Page
    public function add_product()
    {
        $suppliers = Suppliers::orderBy('id', 'DESC')->get();

        $type = Type::orderBy('id', 'DESC')->get();

        return view('product.add_new_product', compact('suppliers','type'));
    }


    // Store Supplier (mobile field nathi — fakt name + address)
    public function store(Request $request)
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


        $supplier = Suppliers::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
        ]);


        return response()->json([
            'status' => true,
            'message' => 'સપ્લાયર સફળતાપૂર્વક ઉમેરાયો.',
            'supplier' => $supplier,
        ]);
    }
}
