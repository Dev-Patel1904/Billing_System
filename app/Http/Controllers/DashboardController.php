<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Date Filter
        |--------------------------------------------------------------------------
        */

        $isFiltered = $request->filled('from_date')
            || $request->filled('to_date');

        $fromDate = $request->query(
            'from_date',
            now()->format('Y-m-d')
        );

        $toDate = $request->query(
            'to_date',
            now()->format('Y-m-d')
        );


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'from_date' => [
                'nullable',
                'date',
            ],

            'to_date' => [
                'nullable',
                'date',
                'after_or_equal:from_date',
            ],
        ], [
            'from_date.date' =>
                'શરૂઆતની તારીખ માન્ય નથી.',

            'to_date.date' =>
                'અંતિમ તારીખ માન્ય નથી.',

            'to_date.after_or_equal' =>
                'અંતિમ તારીખ શરૂઆતની તારીખ કરતા નાની હોઈ શકે નહીં.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Dashboard Cards
        |--------------------------------------------------------------------------
        */

        if ($isFiltered) {

            // -------------------------------------------------
            // FILTERED DATE RANGE
            // -------------------------------------------------

            $startDateTime = $fromDate . ' 00:00:00';

            $endDateTime = $toDate . ' 23:59:59';


            /*
            |--------------------------------------------------------------------------
            | આજનું વેચાણ
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | This always shows TODAY'S sales.
            | Date filter does NOT affect this card.
            |
            */

            $todaysSales = Bill::whereDate(
                'created_at',
                now()->format('Y-m-d')
            )->sum('grand_total');


            /*
            |--------------------------------------------------------------------------
            | આજના બિલ
            |--------------------------------------------------------------------------
            |
            | This DOES change according to selected date range.
            |
            */

            $todaysBillCount = Bill::whereBetween('created_at', [
                $startDateTime,
                $endDateTime
            ])->count();


            /*
            |--------------------------------------------------------------------------
            | બાકી લેણું
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Always shows current total outstanding balance.
            | Date filter does NOT affect this card.
            |
            */

            $totalDue = Customer::sum('balance_due');


            /*
            |--------------------------------------------------------------------------
            | ગ્રાહકો
            |--------------------------------------------------------------------------
            |
            | Changes according to selected date range.
            |
            */

            $totalCustomers = Bill::whereBetween('created_at', [
                $startDateTime,
                $endDateTime
            ])
                ->whereNotNull('customer_id')
                ->distinct('customer_id')
                ->count('customer_id');

        } else {

            // -------------------------------------------------
            // NORMAL DASHBOARD = TODAY
            // -------------------------------------------------

            $today = now()->format('Y-m-d');


            /*
            |--------------------------------------------------------------------------
            | આજનું વેચાણ
            |--------------------------------------------------------------------------
            */

            $todaysSales = Bill::whereDate(
                'created_at',
                $today
            )->sum('grand_total');


            /*
            |--------------------------------------------------------------------------
            | આજના બિલ
            |--------------------------------------------------------------------------
            */

            $todaysBillCount = Bill::whereDate(
                'created_at',
                $today
            )->count();


            /*
            |--------------------------------------------------------------------------
            | બાકી લેણું
            |--------------------------------------------------------------------------
            */

            $totalDue = Customer::sum('balance_due');


            /*
            |--------------------------------------------------------------------------
            | ગ્રાહકો
            |--------------------------------------------------------------------------
            */

            $totalCustomers = Bill::whereDate(
                'created_at',
                $today
            )
                ->whereNotNull('customer_id')
                ->distinct('customer_id')
                ->count('customer_id');


            $fromDate = $today;
            $toDate = $today;
        }


        /*
        |--------------------------------------------------------------------------
        | Year Selector
        |--------------------------------------------------------------------------
        */

        $selectedYear = (int) $request->query(
            'year',
            now()->year
        );


        $availableYears = Bill::selectRaw(
            'DISTINCT YEAR(created_at) as year'
        )
            ->pluck('year')
            ->push(now()->year)
            ->unique()
            ->sortDesc()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Monthly Sales Chart
        |--------------------------------------------------------------------------
        |
        | Without filter:
        |     Complete selected year.
        |
        | With filter:
        |     Only selected date range.
        |
        */

        $monthlyQuery = Bill::selectRaw(
            'MONTH(created_at) as month, SUM(grand_total) as total'
        );


        if ($isFiltered) {

            /*
            | Apply date filter to chart
            */

            $monthlyQuery->whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ]);

        } else {

            /*
            | Normal yearly chart
            */

            $monthlyQuery->whereYear(
                'created_at',
                $selectedYear
            );
        }


        $monthlyTotalsRaw = $monthlyQuery
            ->groupBy('month')
            ->pluck('total', 'month');


        /*
        |--------------------------------------------------------------------------
        | January -> December
        |--------------------------------------------------------------------------
        */

        $monthlyTotals = [];

        for ($m = 1; $m <= 12; $m++) {

            $monthlyTotals[] = (float) (
                $monthlyTotalsRaw[$m] ?? 0
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Cash vs Due
        |--------------------------------------------------------------------------
        */

        if ($isFiltered) {

            /*
            | Cash in selected date range
            */

            $cashTotal = Bill::whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ])
                ->where('payment_type', 'cash')
                ->sum('grand_total');


            /*
            | Due in selected date range
            */

            $dueTotal = Bill::whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ])
                ->where('payment_type', 'due')
                ->sum('grand_total');

        } else {

            /*
            | Overall Cash
            */

            $cashTotal = Bill::where(
                'payment_type',
                'cash'
            )->sum('grand_total');


            /*
            | Overall Due
            */

            $dueTotal = Bill::where(
                'payment_type',
                'due'
            )->sum('grand_total');
        }


        /*
        |--------------------------------------------------------------------------
        | Cash / Due Percentage
        |--------------------------------------------------------------------------
        */

        $cashDueGrandTotal = $cashTotal + $dueTotal;


        $cashPercent = $cashDueGrandTotal > 0
            ? round(
                ($cashTotal / $cashDueGrandTotal) * 100
            )
            : 0;


        $duePercent = $cashDueGrandTotal > 0
            ? round(
                ($dueTotal / $cashDueGrandTotal) * 100
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Recent Bills
        |--------------------------------------------------------------------------
        */

        $recentBills = Bill::with('customer')
            ->latest()
            ->limit(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Total Bills
        |--------------------------------------------------------------------------
        */

        $totalBillsCount = Bill::count();


        /*
        |--------------------------------------------------------------------------
        | Pending Due Customers
        |--------------------------------------------------------------------------
        */

        $pendingCustomers = Customer::where(
            'balance_due',
            '>',
            0
        )
            ->orderByDesc('balance_due')
            ->limit(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view('product.dashboard', compact(

            // Dashboard Cards
            'todaysSales',
            'todaysBillCount',
            'totalDue',
            'totalCustomers',

            // Monthly Chart
            'monthlyTotals',
            'selectedYear',
            'availableYears',

            // Cash / Due
            'cashTotal',
            'dueTotal',
            'cashPercent',
            'duePercent',

            // Recent Bills
            'recentBills',
            'totalBillsCount',
            'pendingCustomers',

            // Date Filter
            'fromDate',
            'toDate',
            'isFiltered'
        ));
    }
}
