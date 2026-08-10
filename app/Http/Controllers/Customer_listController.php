<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Customer_listController extends Controller
{
    // Show customer_list page
    public function customer_list(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('sort', 'desc');

        $customers = Customer::withCount('bills')
            ->withSum('bills', 'total_amount')
            ->with(['bills' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('mobile', 'like', "%{$search}%");
                });
            })
            ->when($sort === 'due', function ($query) {
                $query->where('balance_due', '!=', 0);
            })
            ->when($sort === 'asc', function ($query) {
                $query->orderBy('created_at', 'asc');
            })
            ->when($sort !== 'asc', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(10)
            ->withQueryString();

        return view('list.customer_list', compact('customers', 'search', 'sort'));
    }


    // Add New Customer (modal)
    public function store(Request $request)
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
                'unique:customers,mobile',
            ],
        ], [
            'name.required' => 'ગ્રાહકનું નામ દાખલ કરો.',
            'name.max' => 'ગ્રાહકનું નામ ખૂબ લાંબું છે.',
            'name.regex' => 'ગ્રાહકના નામમાં માત્ર અક્ષરો અને સ્પેસ હોવા જોઈએ.',
            'mobile.required' => 'મોબાઇલ નંબર દાખલ કરો.',
            'mobile.digits' => 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.',
            'mobile.unique' => 'આ મોબાઇલ નંબર પહેલેથી નોંધાયેલ છે.',
        ]);

        try {
            $customer = Customer::create([
                'name' => $validated['name'],
                'mobile' => $validated['mobile'],
                'balance_due' => 0,
            ]);

            return response()->json([
                'status'   => true,
                'message'  => 'ગ્રાહક સફળતાપૂર્વક ઉમેરાયો.',
                'customer' => $customer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'ગ્રાહક ઉમેરવામાં ભૂલ આવી.',
            ], 500);
        }
    }


    // Update Customer (Edit Modal)
    public function update(Request $request, Customer $customer)
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
                Rule::unique('customers', 'mobile')->ignore($customer->id),
            ],
        ], [
            'name.required' => 'ગ્રાહકનું નામ દાખલ કરો.',
            'name.max' => 'ગ્રાહકનું નામ ખૂબ લાંબું છે.',
            'name.regex' => 'ગ્રાહકના નામમાં માત્ર અક્ષરો અને સ્પેસ હોવા જોઈએ.',
            'mobile.required' => 'મોબાઇલ નંબર દાખલ કરો.',
            'mobile.digits' => 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.',
            'mobile.unique' => 'આ મોબાઇલ નંબર પહેલેથી નોંધાયેલ છે.',
        ]);

        try {
            $customer->update($validated);

            return response()->json([
                'status'   => true,
                'message'  => 'ગ્રાહક સફળતાપૂર્વક અપડેટ થયો.',
                'customer' => $customer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'ગ્રાહક અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);
        }
    }


    // View one customer's bills (with search / date / payment-type filter + pagination)
    public function customerBills(Request $request, Customer $customer)
    {
        $search = $request->query('search');
        $date = $request->query('date');
        $paymentType = $request->query('payment_type');

        $bills = $customer->bills()
            ->withCount('items')
            ->when($search, function ($query) use ($search) {
                // Allow searching "1001" or "BILL-1001" — strip prefix/zeros either way
                $cleanSearch = preg_replace('/[^0-9]/', '', $search);
                $query->where(function ($q) use ($search, $cleanSearch) {
                    $q->where('bill_no', 'like', "%{$search}%");
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

        return view('billing.customer_bills', compact('customer', 'bills', 'search', 'date', 'paymentType'));
    }
}
