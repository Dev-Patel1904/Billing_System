<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_name',
        'qty',
        'rate',
        'total',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
