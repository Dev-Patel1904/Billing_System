<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class BillItem extends Model
{
    protected $fillable = [
        'bill_id',
        'product_name',
        'qty',
        'prakar',
        'rate',
        'amount',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'prakar');
    }
}
