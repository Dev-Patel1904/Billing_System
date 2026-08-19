<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraProduct extends Model
{
    protected $table = 'extra_product';
    
    protected $fillable = [
        'product_name',
        'prakar',
        'prakar_text',
        'rate'
    ];
}