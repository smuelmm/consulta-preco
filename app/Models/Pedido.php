<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $table = 'pedidos';

    protected $fillable = [
        'OriginalId',
        'OrderPlacementDate',
        'OrderTotal',
        'OrderStatus',
        'IsCompleted',
        'OrderCompletedDate',
        'customer_id',
        'Feito'
    ];

    protected $casts = [
        'IsCompleted' => 'boolean',
        'OrderPlacementDate' => 'datetime',
        'OrderCompletedDate' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Cliente::class, 'customer_id');
    }
}
