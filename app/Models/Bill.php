<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'customer_id', 'total_qty', 'total_amount',
        'previous_due', 'due_paid_now', 'grand_total',
        'payment_type', 'created_by',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(BillItem::class);
    }
}
