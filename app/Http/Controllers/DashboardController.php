<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    // Page Show
    public function dashboard(Request $request)
    {
        $today = Carbon::today();

        // --- Top stat cards ---
        $todaysSales = Bill::whereDate('created_at', $today)->sum('grand_total');
        $todaysBillCount = Bill::whereDate('created_at', $today)->count();

        // બાકી લેણું — total outstanding due across ALL customers
        $totalDue = Customer::sum('balance_due');

        $totalCustomers = Customer::count();

        // --- Year selector for the monthly chart ---
        $selectedYear = (int) $request->query('year', now()->year);

        $availableYears = Bill::selectRaw('DISTINCT YEAR(created_at) as year')
            ->pluck('year')
            ->push(now()->year)
            ->unique()
            ->sortDesc()
            ->values();

        // --- Monthly sales chart (selected year, Jan -> Dec) ---
        $monthlyTotalsRaw = Bill::selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyTotals = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyTotals[] = (float) ($monthlyTotalsRaw[$m] ?? 0);
        }

        // --- Cash vs Due summary (overall) ---
        $cashTotal = Bill::where('payment_type', 'cash')->sum('grand_total');
        $dueTotal = Bill::where('payment_type', 'due')->sum('grand_total');

        $cashDueGrandTotal = $cashTotal + $dueTotal;

        $cashPercent = $cashDueGrandTotal > 0 ? round(($cashTotal / $cashDueGrandTotal) * 100) : 0;
        $duePercent = $cashDueGrandTotal > 0 ? round(($dueTotal / $cashDueGrandTotal) * 100) : 0;

        // --- Recent bills table ---
        $recentBills = Bill::with('customer')
            ->latest()
            ->limit(4)
            ->get();

        $totalBillsCount = Bill::count();

        // --- Pending due customers (top 3 by amount owed) ---
        $pendingCustomers = Customer::where('balance_due', '>', 0)
            ->orderByDesc('balance_due')
            ->limit(3)
            ->get();

        return view('product.dashboard', compact(
            'todaysSales',
            'todaysBillCount',
            'totalDue',
            'totalCustomers',
            'monthlyTotals',
            'selectedYear',
            'availableYears',
            'cashTotal',
            'dueTotal',
            'cashPercent',
            'duePercent',
            'recentBills',
            'totalBillsCount',
            'pendingCustomers'
        ));
    }
}
