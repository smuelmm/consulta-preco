<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Conteudo;

class ConteudoController extends Controller
{
    
    // get -> inicia o processo
    public function index()
    {
        //$registros = Conteudo::where('id',0)->get();
	$registros = \DB::table('ucolmeia.conteudos')->where('id', 0)->get();
        return view('conteudo', ['registros' => $registros]);
    }

    // post -> grava o registro na base de dados
    public function put(Request $request){
    	// Insere o novo registro
    	DB::table('ucolmeia.conteudos')->insert([
        'referencia' => $request->referencia,
        'url' => $request->url,
        'created_at' => now(),
        'updated_at' => now()
    	]);
    
    	// Conta os registros com a mesma referência
    	$qtd = DB::table('ucolmeia.conteudos')
        	->where('referencia', $request->referencia)
        	->count();
    
    	$mensagem = utf8_encode('Conteúdo registrado. ') . $qtd . utf8_encode(' registros gravados da referência ') . $request->referencia;
    
    	return back()->with('msg', $mensagem);
	}
    	// botÃ£o consulta apresenta a base de dados do mais recente para mais antigo

    public function consulta() {
        $registros = DB::table('ucolmeia.conteudos')->orderBy('id','desc')->paginate(100);
        return view('conteudo', ['registros' => $registros]);
    }

    public function apaga($id = null){
    	// Busca o registro - equivalente ao Conteudo::find($id)
    	$conteudo = DB::table('ucolmeia.conteudos')
        	    ->where('id', $id)
        	    ->first();
    
    	// Verifica se encontrou algo (equivalente ao if($conteudo))
    	if ($conteudo) {
        // Deleta o registro - equivalente ao $conteudo->delete()
        DB::table('ucolmeia.conteudos')
            ->where('id', $id)
            ->delete();
    	}
    
    	return redirect('/conteudoConsulta');
    }

    // link que vai no sms para redireciona para o conteÃºdo correto ex: localhost:80000/mv/123456789 
    public function direciona ($referencia = null) {
        $url = DB::table('ucolmeia.conteudos')->where('referencia', $referencia)->value('url');
        if ($url){
            return redirect($url);
        } else {
            return redirect('https://atacado.modacolmeia.com/');
        }
    }
}
