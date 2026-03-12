<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upconteudo;
use App\Models\Conteudo;
use Illuminate\Support\Facades\DB;

class UpconteudoController extends Controller
{
    //
    public function index()
    {
        return view('upload');
    }

    // limpa a tabela Upconteudos e carrega o conteudo de um arquivo txt
    public function store(Request $request){
    	$request->validate([
        	'arquivo' => 'required|file|mimes:txt'
    	]);
    
    	DB::table('ucolmeia.upconteudos')->delete();;
    
    	$file = $request->file('arquivo');
    	$path = $file->getRealPath();
    
    	foreach (file($path) as $linha) {
        	DB::table('ucolmeia.upconteudos')->insert([
        	    'linha' => trim($linha),
        	    'created_at' => now(),
        	    'updated_at' => now()
        	]);
    	}
    
    	$mensagem = utf8_encode('Arquivo processado com sucesso! Para concluir efetue commit usando [Processar Carga].');
    
    	return back()->with('ok', $mensagem);
    }

    // carrega na tabela conteudos as referencias e links gravadas na tabela upconteudos
    public function executar(){
    	$tabela = DB::table('ucolmeia.upconteudos')->get();
    
    	foreach ($tabela as $registro) {
        	$linha = $registro->linha;
        	$pos = strpos($linha, 'https');
        
        	if ($pos !== false) {
            		$referencia = substr($linha, 3, 1) . substr($linha, 5, 2) . 
                              	      substr($linha, 8, 2) . substr($linha, 11, 1) . 
                                      substr($linha, 13, 4);
            
            		$link = substr($linha, $pos, 512);
            
            		$quantidade = DB::table('ucolmeia.conteudos')
                		->where('referencia', $referencia)
                		->where('url', $link)
                		->count();
            
            		if ($quantidade == 0) {
                		DB::table('ucolmeia.conteudos')->insert([
                    						'referencia' => $referencia,
                    						'url' => $link,
                    						'created_at' => now(),
                    						'updated_at' => now()
                						]);
            		}
            	}
    	}
    
    	return redirect('/conteudoConsulta');
    }
}
