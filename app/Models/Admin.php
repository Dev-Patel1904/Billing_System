<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'mobile',
        'email',
        'pin',
        'otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'pin',
        'otp',
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
    ];
}
