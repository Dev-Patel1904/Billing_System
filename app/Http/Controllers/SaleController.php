<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Show Page (list)
    public function sales()
    {
        $bills = Bill::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('sales.sales', compact('bills'));
    }


    // Show Page (single bill detail)
    public function show_sales(Bill $bill)
    {
        $bill->load('customer', 'items');

        return view('sales.show_sales', compact('bill'));
    }
}
