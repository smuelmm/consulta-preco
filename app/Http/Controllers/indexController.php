<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

use Detection\MobileDetect;

use App\Models\consulta;
use App\Models\consultar;

class indexController extends Controller{
    // controle entidade usuarios
    public function index () {

    Cookie::queue(Cookie::forget('nome'));

    $script = "<script>
                    window.history.pushState(null, '', window.location.href);
                    window.onpopstate = function () {
                        window.history.pushState(null, '', window.location.href);
                    };
                </script>";

    $cdp=null;
    $cdv=null;
    return view('/login')->with('script', $script);
    }

    public function comeceLogin (Request $request) {
	Cookie::queue(Cookie::forget('nome'));
        $cdp = $request->input('cdp');
        $cdv = $request->input('cdv');
        
        if (!empty(\DB::select("SELECT * FROM ucolmeia.CR_PES_VENDEDOR WHERE CD_PESSOA=$cdp AND CD_VENDEDOR=$cdv"))){
            $dados = \DB::select("SELECT CD_LOJA FROM ucolmeia.CR_PES_VENDEDOR WHERE CD_PESSOA=$cdp AND CD_VENDEDOR=$cdv");
            $loja = \DB::select("SELECT LOJA FROM ucolmeia.CR_PES_VENDEDOR WHERE CD_PESSOA=$cdp AND CD_VENDEDOR=$cdv");
	    $resultado = \DB::select("SELECT NM_VENDEDOR FROM ucolmeia.CR_PES_VENDEDOR WHERE CD_PESSOA=$cdp AND CD_VENDEDOR=$cdv");

	    $nome = $resultado[0]->nm_vendedor;
    	    Cookie::queue('nome', $nome, 1440);

            return view('/consulta', [
                'dados' => $dados[0],
                'loja' => $loja
            ]);
        } else {
            echo "Usuário não registrado em como parte de uma loja.";
            echo '<script>
            setTimeout(function() {
                history.back();
            }, 2000);
            </script>';
        }
    }

    public function consulta () {
    return view('/consulta');
    }

    public function consultar2(Request $request){
    $codigo = explode("#", $request->input('codigo'))[0];
    // Execute sua consulta ao banco de dados aqui
    // Substitua isso pelo código real para obter o DS_GRUPO
    $dsGrupo = 'Resultado da consulta para ' . $codigo;

    return $dsGrupo;
    }


    public function dbconn () {
    return view('/dbconn');
    }

    public function estoques (Request $request) {
    $select3 = $request->input('descricaogrupo');
    $selectall = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
                ->select('tamanho', 'cor', 'cd_empresa', 'vl_saldo_fisico')
                ->whereIn('ds_grupo', [$select3])
                ->whereNotIn('cd_empresa', [880])
                ->orderBy('tamanho', 'ASC')
                ->orderBy('cor')
                ->get()
                ->toArray();

    $Aloja = $request->input('loja');

    $lojas = \DB::select("SELECT DISTINCT CD_LOJA,LOJA FROM ucolmeia.CR_PES_VENDEDOR WHERE CD_LOJA != 880 ORDER BY CD_LOJA ASC");

    $fabrica = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
                ->select('tamanho', 'cor', 'cd_empresa', 'vl_saldo_fisico')
                ->whereIn('ds_grupo', [$select3])
                ->whereIn('cd_empresa', [1])
                ->orderBy('tamanho', 'ASC')
                ->orderBy('cor')
                ->get()
                ->toArray();

        return view('estoques', [
            'tabela' => $selectall,
            'lojas' => $lojas,
            'fabrica' => $fabrica,
            'Aloja' => $Aloja
        ]);
    }

    public function consultarbarra (Request $request) {

    $detect = new MobileDetect;
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $isIPad = preg_match('/ipad/i',$user_agent);

    // Trate qualquer iPad como mobile
    $isMobile = $isMobile || $isIPad;

    $isDesktop = !$isMobile && !$isTablet && !$isIPad;

    $result = $request->input('codigo');
    $limitacao = $request->input('cdempresa');
    $codigodebarra = explode("#", $result)[0];
    //Condição com Consulta e Sub-consulta
    if(\DB::select("SELECT CD_PRODUTO FROM ucolmeia.CR_CONSULTA_PRECO WHERE CD_PRODUTO = (SELECT CD_PRODUTO FROM ucolmeia.VR_PRD_CODIGOBARRA where CD_BARRAPRD = '$codigodebarra' AND ROWNUM <= 1) AND ROWNUM <= 1")){

        $teste=\DB::select("SELECT CD_PRODUTO FROM ucolmeia.VR_PRD_CODIGOBARRA where CD_BARRAPRD = '$codigodebarra'");
        //Tira o stdClass (Não encontrei forma melhor pra tirar isso)
        $teste2=json_decode(json_encode($teste), true);
        $key=$teste2[0];
        $codigo=intval($key['cd_produto']);

        $collectpreco = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
                        ->select('cd_produto', 'ds_grupo', 'preco_original', 'preco_final', 'cd_empresa', 'ds_descricao', 'tamanho', 'cor', 'vl_saldo_fisico', 'local')
                        ->where('cd_produto', $codigo)
                        ->where('cd_empresa', $limitacao)
                        ->orderBy('tamanho', 'DESC')
                        ->orderBy('cor')
                        ->get();

	$precocerto = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
                        ->select('preco_original', 'preco_final')
                        ->where('cd_produto', $codigo)
                        ->where('cd_empresa', $limitacao)
                        ->orderBy('tamanho', 'DESC')
                        ->orderBy('cor')
                        ->first();


        $loja = \DB::table('ucolmeia.CR_PES_VENDEDOR')
                ->select('LOJA')
                ->where('CD_LOJA', $limitacao)
                ->orderBy('CD_LOJA', 'ASC')
                ->limit(1)
                ->get()
                ->toArray(); 

        $select3=\DB::select("SELECT DS_GRUPO FROM ucolmeia.CR_CONSULTA_PRECO where CD_PRODUTO = '$codigo'");
        $convert=json_decode(json_encode($select3), true);
        $selectit = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
                ->select('tamanho', 'cor', 'cd_empresa', 'vl_saldo_fisico')
                ->where('ds_grupo', $convert)
                ->where('cd_empresa', $limitacao)
                ->orderBy('tamanho', 'ASC')
                ->orderBy('cor')
                ->get()
                ->toArray();

        return view('consultaFeita', [
            'consultarpreco' => $collectpreco,
	    'precocerto' => $precocerto,
            'limitacao' => $limitacao,
            'tabela' => $selectit,
            'loja' => $loja,
        ], compact('isDesktop'), compact('isMobile'), compact('isIPad'));
    }else{
        echo "Código não encontrado. Voltando para a consulta.";
        echo '<script>
        setTimeout(function() {
            history.back();
        }, 2000);
        </script>';
    }
    }

    public function consultar(Request $request) {
        $detect = new MobileDetect;
        $isMobile = $detect->isMobile();
        $isTablet = $detect->isTablet();
        $userAgent = $detect->getUserAgent();
        $isIPad = $detect->isTablet() && $detect->is('iPad');
        $isIPadPro = $detect->isTablet() && strpos($userAgent, 'iPad; CPU OS') !== false && strpos($userAgent, 'iPad Pro') !== false;
        $isDesktop = !$isMobile && !$isTablet && !$isIPad && !$isIPadPro;

        $codigo = '';
        for ($i = 1; $i <= 5; $i++) {
            $codigo .= $request->input("codigods{$i}");
            if ($i != 5) {
                $codigo .= ' ';
            }
        }

	$codigo = mb_strtoupper($codigo);
	
        if(\DB::select("SELECT CD_PRODUTO FROM ucolmeia.CR_CONSULTA_PRECO where ds_grupo = '$codigo' AND ROWNUM <= 1")){
            $limitacao = $request->input('cdempresa');
            $collectpreco = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
    					->select('cd_produto', 'ds_grupo', 'preco_original', 'preco_final', 'cd_empresa', 'ds_descricao', 'tamanho', 'cor', 'vl_saldo_fisico', 'local')
    					->where('ds_grupo', $codigo)
    					->where('cd_empresa', $limitacao)
       					->orderBy('tamanho', 'DESC')
    					->orderBy('cor')
    					->get();

	    $precos = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
    					->select('preco_original', 'preco_final')
    					->where('ds_grupo', $codigo)
    					->where('cd_empresa', $limitacao)
    					->whereNotNull('preco_final')
    					->where('preco_original', '!=', 0)
       					->first();

            $loja = \DB::table('ucolmeia.CR_PES_VENDEDOR')
                ->select('LOJA')
                ->where('CD_LOJA', $limitacao)
                ->orderBy('CD_LOJA', 'ASC')
                ->limit(1)
                ->get()
                ->toArray(); 

            $select3=\DB::select("SELECT DS_GRUPO FROM ucolmeia.CR_CONSULTA_PRECO where ds_grupo = '$codigo'");
                $convert=json_decode(json_encode($select3), true);
                $selectit = \DB::table('ucolmeia.CR_CONSULTA_PRECO')
                ->select('tamanho', 'cor', 'cd_empresa', 'vl_saldo_fisico')
                ->where('ds_grupo', $convert)
                ->where('cd_empresa', $limitacao)
                ->orderBy('tamanho', 'ASC')
                ->orderBy('cor')
                ->get()
                ->toArray();

            return view('consultaFeita', [
                'consultarpreco' => $collectpreco,
                'limitacao' => $limitacao,
                'tabela' => $selectit,
                'loja' => $loja,
		'precos' => $precos
            ], compact('isDesktop'), compact('isMobile'));
        } else {
            echo "Código não encontrado. Voltando para a consulta.";
            echo '<script>
            setTimeout(function() {
                history.back();
            }, 2000);
            </script>';
        }
    }

}
