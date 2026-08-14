<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\PurchaseItem;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class BillingController extends Controller
{
    public function create()
    {
        $products = PurchaseItem::query()
        ->whereNotNull('product_name')
        ->where('product_name', '!=', '')
        ->select(
            'product_name',
            'prakar',
            'prakar_text',
            'rate'
        )
        ->orderBy('product_name')
        ->get()
        ->unique('product_name')
        ->values();

    return view('billing.new-billing', compact('products'));
    }

    public function checkCustomer(Request $request)
    {
        $validated = $request->validate([
            'mobile' => ['required', 'digits:10'],
        ]);

        $customer = Customer::where('mobile', $validated['mobile'])->first();

        if (!$customer) {
            return response()->json(['exists' => false]);
        }

        return response()->json([
            'exists'     => true,
            'name'       => $customer->name,
            'due_amount' => (float) $customer->balance_due,
        ]);
    }

    // ==========================================
    // NEW: Immediately settle a due payment
    // (called from modal "સેવ કરો" button via AJAX)
    // ==========================================
    public function payDue(Request $request)
    {
        $validated = $request->validate([
            'customer_mobile' => ['required', 'digits:10'],
            'paid_amount'      => ['required', 'numeric', 'min:0.01'],
        ]);

        $customer = Customer::where('mobile', $validated['customer_mobile'])->first();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'ગ્રાહક મળ્યો નથી.',
            ], 404);
        }

        if ($validated['paid_amount'] > $customer->balance_due) {
            return response()->json([
                'success' => false,
                'message' => 'ચૂકવણી રકમ બાકી રકમ કરતાં વધુ હોઈ શકે નહીં.',
            ], 422);
        }

        $customer->balance_due = $customer->balance_due - $validated['paid_amount'];
        $customer->save();

        return response()->json([
            'success'       => true,
            'message'       => 'બાકી રકમ સફળતાપૂર્વક ચૂકવાઈ ગઈ.',
            'remaining_due' => (float) $customer->balance_due,
        ]);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
    'customer_mobile' => ['required', 'digits:10'],
    'customer_name'   => ['required', 'string', 'max:150'],

    'previous_due'    => ['nullable', 'numeric', 'min:0'],
    'due_paid_now'    => ['nullable', 'numeric', 'min:0'],

    'payment_type'    => ['required', 'in:cash,due'],

    'product_name'    => ['required', 'array', 'min:1'],
    'product_name.*'  => ['required', 'string', 'max:255'],

    'qty'             => ['required', 'array', 'min:1'],
    'qty.*'           => ['required', 'numeric', 'min:0.01'],

    'prakar'          => ['required', 'array', 'min:1'],
    'prakar.*'        => ['required', 'string', 'max:50'],

    'rate'            => ['required', 'array', 'min:1'],
    'rate.*'          => ['required', 'numeric', 'min:0'],
], [
    'product_name.required' => 'ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.',
]);

        // previous_due / due_paid_now are now purely INFORMATIONAL for this
        // bill record — the actual customer balance was already updated
        // by payDue() at the moment the modal's "સેવ કરો" was clicked.
        $previousDue = (float) ($validated['previous_due'] ?? 0);
        $duePaidNow  = (float) ($validated['due_paid_now'] ?? 0);

        $totalQty    = 0;
        $totalAmount = 0;

        foreach ($validated['qty'] as $i => $qty) {
            $totalQty    += $qty;
            $totalAmount += $qty * $validated['rate'][$i];
        }

        // ચૂકવવાની કુલ રકમ = ONLY the current bill's product total.
        // Due payments never affect this number.
        $grandTotal = $totalAmount;

        $bill = DB::transaction(function () use (
            $validated,
            $totalQty,
            $totalAmount,
            $previousDue,
            $duePaidNow,
            $grandTotal
        ) {
            $customer = Customer::firstOrCreate(
                ['mobile' => $validated['customer_mobile']],
                ['name' => $validated['customer_name'], 'balance_due' => 0]
            );
            $customer->name = $validated['customer_name'];

            // Only THIS bill's amount affects balance now (if left unpaid).
            // Any due payment was already deducted via payDue().
            if ($validated['payment_type'] === 'due') {
                $customer->balance_due = $customer->balance_due + $totalAmount;
            }

            $customer->save();

            // Generate unique bill number, e.g. B260807164512384
            $billNo = 'B' . now()->format('ymdHis') . rand(100, 999);

            $bill = Bill::create([
                'bill_no'      => $billNo,
                'customer_id'  => $customer->id,
                'total_qty'    => $totalQty,
                'total_amount' => $totalAmount,
                'previous_due' => $previousDue, // informational record only
                'due_paid_now' => $duePaidNow,  // informational record only
                'grand_total'  => $grandTotal,
                'payment_type' => $validated['payment_type'],
                'created_by'   => auth()->id(),
            ]);

            foreach ($validated['product_name'] as $i => $productName) {

    BillItem::create([
        'bill_id'      => $bill->id,
        'product_name' => $productName,
        'qty'          => $validated['qty'][$i],
        'prakar'       => $validated['prakar'][$i],
        'rate'          => $validated['rate'][$i],
        'amount'       => $validated['qty'][$i] * $validated['rate'][$i],
    ]);
}

            return $bill->load('items', 'customer');
        });
       return redirect()->route('billing.pdf', ['bill' => $bill->id]);


    }
    public function pdf($id)
    {
        $bill = Bill::with([
            'items',
            'customer'
        ])->findOrFail($id);

        return view('billing.pdf', compact('bill'));
    }

    // ==========================================
    // NEW: Reprint an existing bill's PDF
    // ==========================================
    public function printBill(Bill $bill)
    {
        $bill->load('items', 'customer');

        $html = view('billing.pdf', ['bill' => $bill])->render();

        $mpdf = new Mpdf(config('mpdf'));
        $mpdf->WriteHTML($html);

        return response($mpdf->Output($bill->bill_no . '.pdf', \Mpdf\Output\Destination::INLINE))
            ->header('Content-Type', 'application/pdf');
    }
}
