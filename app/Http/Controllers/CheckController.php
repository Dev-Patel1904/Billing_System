<?php

namespace App\Http\Controllers;

use App\Models\PurchasePayment;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    // Check List Page (with filters)
    public function index(Request $request)
    {
        $date         = $request->query('date');
        $checkNumber  = $request->query('check_number');
        $supplierId   = $request->query('supplier_id');

        $checks = PurchasePayment::with('purchase.supplier')
            ->where('payment_method', 'check')
            ->when($date, function ($query) use ($date) {
                $query->whereDate('check_date', $date);
            })
            ->when($checkNumber, function ($query) use ($checkNumber) {
                $query->where(function ($q) use ($checkNumber) {
                    $q->where('check_number', 'like', "%{$checkNumber}%")
                      ->orWhereHas('purchase', function ($pq) use ($checkNumber) {
                          $pq->where('billing_no', 'like', "%{$checkNumber}%");
                      });
                });
            })
            ->when($supplierId, function ($query) use ($supplierId) {
                $query->whereHas('purchase', function ($pq) use ($supplierId) {
                    $pq->where('supplier_id', $supplierId);
                });
            })
            ->orderBy('check_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $suppliers = Suppliers::orderBy('name')->get();

        return view('check.check_list', compact('checks', 'suppliers', 'date', 'checkNumber', 'supplierId'));
    }

    // Update check status: pass / bounce / cancel
    public function updateStatus(Request $request, PurchasePayment $payment)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:passed,bounced,cancelled'],
        ]);

        try {

            $payment->update([
                'status' => $validated['status'],
            ]);

            $labels = [
                'passed'    => 'ચેક પાસ થયો.',
                'bounced'   => 'ચેક બાઉન્સ થયો.',
                'cancelled' => 'ચેક રદ કરવામાં આવ્યો.',
            ];

            return response()->json([
                'status'  => true,
                'message' => $labels[$validated['status']],
                'new_status' => $validated['status'],
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'સ્થિતિ અપડેટ કરવામાં ભૂલ આવી.',
            ], 500);

        }
    }
}
