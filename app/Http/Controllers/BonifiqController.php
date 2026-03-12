<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\OrderApiLog;
use Illuminate\Support\Facades\Http;

class BonifiqController extends Controller
{
    //
        public function bonifiq () {

        // recupera os dados
        $pedidos = DB::table('ucolmeia.ti_pedidos as p')
    	->select('p.*', 'c.name as customer', 'c.originalid as customerid')
    	->leftJoin('ucolmeia.ti_clientes as c', 'p.customer_id', '=', 'c.id')
    	->where('p.Feito', 0)
    	->get();
	//echo $pedidos;
	//return;

        foreach ($pedidos as $pedido) {

            // monta o array do json
            $customer = $pedido->customer; 
	    //echo $customer;
	    //return;
            $payload = [
            "OriginalId" => (string)$pedido->originalid,
            "OrderPlacementDate" => $pedido->orderplacementdate,
            "OrderTotal" => (float) $pedido->ordertotal,
            "OrderStatus" => $pedido->orderstatus,
            "IsCompleted" => (bool) $pedido->iscompleted,
            "OrderCompletedDate" => $pedido->ordercompleteddate,
            "Customer" => [
                "OriginalId" => (string)$pedido->customerid,
                "Name"       => $customer
                ]
            ];

            // mostra conteúdo e faz a integração
            print_r($payload);
            echo "<hr>";
            $response = Http::withHeaders([
                'Authorization' => 'Basic QVBJVVNFUi1Nb2RhQ29sbWVpLWYxYzc3MjE1ZDIxYTQ1NmM4ZjFiZjA4MzA5MmVjZjIzOkJCNDZIRllNWFg4U1JCUEJHTVBKRE5IQllYQ1Q5Ng==',
                'accept' => 'application/json'
            ])->post("https://api.bonifiq.com.br/v1/pvt/Order", $payload);

            // registrar log
            DB::table('ucolmeia.ti_order_api_logs')->insert([
    	    'order_id'    => $pedido->id,                    // FK real (recomendado)
    	    'http_status' => $response->status(),
    	    'payload'     => json_encode($payload),
    	    'response'    => $response->body(),
    	    'success'     => $response->successful() ? 1 : 0,
    	    'created_at'  => now(),
    	    'updated_at'  => now()
	    ]);
        }
        
        // registra como feito
        DB::table('ucolmeia.ti_pedidos')->update(['feito' => 1]);
    }
}
