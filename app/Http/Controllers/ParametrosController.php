<?php

namespace App\Http\Controllers;

use App\Models\parametrotroca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ParametrotrocaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parametrotrocas = DB::table('ucolmeia.ti_parametrotrocas')->get();
        return view('parametrotroca', ['parametrotrocas' => $parametrotrocas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        /*ParametroTroca::updateOrCreate(
            ['cd_classificacao' => $request->cd_classificacao],
            ['fator' => $request->fator]
        );*/

	$parametro = DB::table('ucolmeia.ti_parametrotrocas')
    	->where('cd_classificacao', $request->cd_classificacao)
    	->first();

	if ($parametro) {
    		// Atualizar se existe
    		DB::table('ucolmeia.ti_parametrotrocas')
        	->where('cd_classificacao', $request->cd_classificacao)
        	->update([
            		'fator' => $request->fator,
            		'updated_at' => now()
        	]);

    		$id = $parametro->id;

		} else {

    		// Criar se não existe
    		$id = DB::table('ucolmeia.ti_parametrotrocas')->insertGetId([
        					'cd_classificacao' => $request->cd_classificacao,
        					'fator' => $request->fator,
        					'created_at' => now(),
        					'updated_at' => now()
    						]);
		}

        return redirect('/parametrotroca');
    }

    /**
     * Display the specified resource.
     */
    public function show(parametrotroca $parametrotroca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(parametrotroca $parametrotroca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, parametrotroca $parametrotroca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id = null)
    {
        //
        $consulta = DB::table('ucolmeia.ti_parametrotrocas')->find($id);
        if ($consulta) {
            $consulta->delete();
        }
        return redirect('/parametrotroca');
    }
}
