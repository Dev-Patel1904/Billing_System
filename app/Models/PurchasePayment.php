<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    protected $fillable = [
        'purchase_id',
        'payment_method',
        'amount',
        'check_number',
        'check_date',
        'check_group_id',
        'status',
        'created_by',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
