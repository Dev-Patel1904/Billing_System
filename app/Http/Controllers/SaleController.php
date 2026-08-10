<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Show Page (list)
    public function sales(Request $request)
    {
        $search = $request->query('search');
        $date = $request->query('date');
        $paymentType = $request->query('payment_type');

        $bills = Bill::with('customer')
            ->when($search, function ($query) use ($search) {

                $cleanSearch = preg_replace('/[^0-9]/', '', $search);

                $query->where(function ($q) use ($search, $cleanSearch) {
                    $q->where('bill_no', 'like', "%{$search}%")
                      ->orWhereHas('customer', function ($cq) use ($search) {
                          $cq->where('name', 'like', "%{$search}%");
                      });

                    if ($cleanSearch !== '') {
                        $q->orWhere('bill_no', 'like', "%{$cleanSearch}%");
                    }
                });

            })
            ->when($date, function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            })
            ->when($paymentType, function ($query) use ($paymentType) {
                $query->where('payment_type', $paymentType);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('sales.sales', compact('bills', 'search', 'date', 'paymentType'));
    }


    // Show Page (single bill detail)
    public function show_sales(Bill $bill)
    {
        $bill->load('customer', 'items');

        return view('sales.show_sales', compact('bill'));
    }
}
