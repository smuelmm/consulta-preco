<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\indexController; 
use App\Http\Controllers\saldotrocaController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\UpconteudoController;
use App\Http\Controllers\BonifiqController;
use App\Http\Controllers\ParametrotrocaController;

Route::get('/', [indexController::class, 'index']);
Route::post('/login', [indexController::class, 'comeceLogin']);
Route::get('/estoques', [indexController::class, 'estoques']);
Route::get('/logout', [indexController::class, 'logout']);
Route::get('/consultarbarra', [indexController::class, 'consultarbarra']);
Route::get('/consulta', [indexController::class, 'consulta']);
Route::get('/consultar', [indexController::class, 'consultar']);
Route::get('/consultar2', [indexController::class, 'consultar2']);
Route::get('/dbconn', [indexController::class, 'dbconn']);
Route::get('/consultaFeita', [indexController::class, 'consultaFeita']);

Route::get('/saldo', [saldotrocaController::class, 'index']); // formulário de inicio
Route::get('/saldoid', [saldotrocaController::class, 'saldoid']); // consulta por cd_pessoa
Route::get('/saldocpf', [saldotrocaController::class, 'saldocpf']); // consulta por cpf ou cnpj
Route::get('/saldonome', [saldotrocaController::class, 'saldonome']); // consulta por nome
Route::get('/saldovalor/{id?}/{valor?}/{nome?}', [saldotrocaController::class, 'saldovalor']); // registra autorização
Route::get('/saldoautorizadas', [saldotrocaController::class, 'saldoautorizadas']); // exibe histórico de autorizações

// redirecionamento de conteúdo
Route::get('/conteudo', [ConteudoController::class, 'index']);
Route::post('/conteudo', [ConteudoController::class, 'put']);
Route::get('/conteudoConsulta', [ConteudoController::class, 'consulta']);
Route::get('/conteudoDel/{id?}', [ConteudoController::class, 'apaga']);
Route::get('/mv/{referencia?}', [ConteudoController::class, 'direciona']);

// carga de conteudos por arquivo
Route::get('/upload', [UpconteudoController::class, 'index']);
Route::post('/upload', [UpconteudoController::class, 'store']);
Route::get('/executar', [UpconteudoController::class, 'executar']);

// teste bonifiq
Route::get('/bonifiq', [BonifiqController::class, 'bonifiq']);

// parâmetro de troca

Route::get('/parametrotroca', [ParametrotrocaController::class, 'index']);
Route::post('/parametrotroca', [ParametrotrocaController::class, 'store']);
Route::get('/parametrotrocaDel/{id?}', [ParametrotrocaController::class, 'destroy']);

Route::get('/check-table', function(){

    $table_name = "ADC_CONDOMINIO";

    if(Schema::hasTable($table_name)){
        echo "<h3>Tabela existe</h3>";
        $collect=\DB::select("SELECT * FROM CR_AUTOESTOQ_FISICO where cd_produto in (332587)");
        $str_json=json_encode($collect);
        echo $str_json;

        /*
        EXEMPLO DE COMO PEGAR INFORMAÃ‡Ã•ES DE TABELAS
        $collect=\DB::select("SELECT cd_transpessoa FROM ADF_FREMAN WHERE CD_TRANSPESSOA=41820");
        $str_json=json_encode($collect);
        echo $str_json;
        */
    }else{
        echo "<h3>Tabela nÃ£o existe</h3>";
    }
});

Route::get('/phpinfo', function(){
    phpinfo();
});