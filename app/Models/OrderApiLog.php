<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderApiLog extends Model
{
    //    
    protected $fillable = [
        'order_id', 'http_status', 'payload',
        'response', 'success'
    ];

    protected $casts = [
        'payload' => 'array',
        'success' => 'boolean'
    ];
}
