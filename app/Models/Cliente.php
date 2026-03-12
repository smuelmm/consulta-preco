<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'clientes';

    protected $fillable = ['OriginalId', 'Name'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'customer_id');
    }
}
