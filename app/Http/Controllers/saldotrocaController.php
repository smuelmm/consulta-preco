<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\saldotroca;
use App\Models\autorizada;

class saldotrocaController extends Controller
{
    //
    public function index () {
        $tabela = \DB::table('ucolmeia.saldotrocas')->where('id', 0)->get(); 
        return view('saldo', ['tabela' => $tabela]);
    }

    public function saldoid (Request $request) {
        if (empty($request->cdpessoa)) {
            return back()->with('msg', 'Código não informado');
        }
        //$tabela = saldotroca::where('id', $request->cdpessoa)->get();
	$tabela = \DB::table('ucolmeia.saldotrocas')->where('id', $request->cdpessoa)->get();
        return view('saldo', ['tabela' => $tabela]);
    }

    public function saldocpf (Request $request) {
        if (empty($request->cpf)) {
            return back()->with('msg', 'CPF ou CNPJ não informado');
        }
        //$tabela = saldotroca::where('cpf', $request->cpf)->get(); // atencao aqui
	$tabela = \DB::table('ucolmeia.saldotrocas')->where('cpf', $request->cpf)->get();
        return view('saldo', ['tabela' => $tabela]);
    }
    
    public function saldonome (Request $request) {
        if (empty($request->nome)) {
            return back()->with('msg', 'Nome não informado');
        }
        $nome = '%' . strtoupper ($request->nome) . '%';
        $nome = str_replace(" ", "%", $nome);
        //$tabela = saldotroca::where('nome', 'like', $nome)->get();
	$tabela = \DB::table('ucolmeia.saldotrocas')->where('nome', 'like', $nome)->get();
        return view('saldo', ['tabela' => $tabela]);
    }

    public function saldovalor ($id = null, $valor = null, $nome = null) {
        \DB::insert("INSERT INTO ucolmeia.autorizadas (pessoa, nome, valor) VALUES (?, ?, ?)", [$id, $nome, $valor]);
        return redirect('/saldo')->with('msg','Autorização para [' . $nome . '] registrada!');
    }

    public function saldoautorizadas () {
        //$autorizadas = Autorizada::orderBy('id', 'desc')->limit(100)->get();
	$autorizadas = \DB::table('ucolmeia.autorizadas')->orderBy('id', 'desc')->limit(100)->get();
        return view ('autorizadas', ['autorizadas' => $autorizadas]);
    }
}
