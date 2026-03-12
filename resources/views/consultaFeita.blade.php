@extends('layouts.layout-consultaFeita')
@section('titulo','Consulta feita')
@section('conteudo')
<?php 
// Inclui o autoloader do Composer
use Detection\MobileDetect;
?>
<link rel="stylesheet" type="text/css" href="css/app.css">
<link rel="icon" type="image/png" href="boxes.svg">
<header>
<div>
  <div style="color: rgb(13, 110, 253, 1.0); text-align: center;">
          @foreach($loja as $loja)
          <h1 class="h3">Consulta
	  <?php

	  if(Cookie::get('nome')!='DPA'){
		echo "pre&ccedil;o";
	  }
	  ?>:
          <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "<br>";
                } elseif ($detect->isTablet()) {
                    echo "<br>";
                }
                ?>
          <?php 
          $pos = strpos($loja->loja, '- ');
          $novaString = substr($loja->loja, $pos + strlen('- '));
          echo $novaString;
          ?>
          </h1>
          @endforeach
        </div>

      </div> 
</div>

</header>
<hr>

@if(empty($precocerto))
<?php
echo '<script>console.log($precos->preco_original);</script>';
?>
@endif


@forelse ($consultarpreco as $consultas)
    @csrf
    @if ($loop->first)
        <form>
          <div style="display: inline-flex;">
            <!--Exibição da imagem via URL-->

            <div style="display: inline-flex;">
              <img src="https://storage.googleapis.com/colm_front_images/<?php echo str_replace(" ","_",$consultas->ds_grupo) ?>.jpg" alt="alternatetext" id="img-consulta" 
                style="width: 
                <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "auto";
                } elseif ($detect->isTablet()) {
                    echo "auto";
                } else {
                    echo "295px";
                } 
                ?>; 
                border-radius: 2em; 
                box-shadow: 3px 3px 3px 0px #888888; 
                margin-left: 
                <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "0px";
                } elseif ($detect->isTablet()) {
                    echo "0px";
                } else {
                    echo "100px";
                } 
                ?>;
                margin-right:
                <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "10px";
                } elseif ($detect->isTablet()) {
                    echo "10px";
                } else {
                    echo "80px";
                } 
                ?>; 
                max-height: 
                <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "200px";
                } elseif ($detect->isTablet()) {
                    echo "200px";
                } else {
                    echo "450px";
                } 
                ?>">
            </div>

            <div class="container-res">
              <!--Detalhes do produto-->
	      @if(Cookie::get('nome')!='DPA')
              <label style="font-weight: 600;" for="produto">Descrição do Produto
              <input type="text" class="form-control" id="DS_PROD" name="descricaoproduto" value="{{$consultas->ds_descricao}}" 
              style="box-shadow: 3px 3px 3px 0px #888888; 
              width: 
              <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "200px";
                } elseif ($detect->isTablet()) {
                    echo "200px";
                } else {
                    echo "492px";
                } 
              ?>; 
              max-width: 
              <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "200px";
                } elseif ($detect->isTablet()) {
                    echo "200px";
                } else {
                    echo "492px";
                } 
              ?>;
              border: black" 
              readonly>
              </label>
              <br></br>
	      @endif
              <div class="detalhes">

              @endif

              <!--Detalhes do produto: Exibição dos preços-->
              @foreach ($consultarpreco as $preco)

                @if($preco->cd_empresa==$limitacao)
                  @once

		    @if(Cookie::get('nome')!='DPA')
                    <label style="font-weight: 600;" for="produto">Preço Original
                      <input type="text" 
                      style="box-shadow: 3px 3px 3px 0px #888888; 
                      width: 
                      <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "200px";
                        } elseif ($detect->isTablet()) {
                            echo "200px";
                        } else {
                            echo "244.5px";
                        } 
                      ?>;" 
                      class="form-control" id="OG" name="og" value=
                      "<?php 

                      			echo "R$ ".str_replace('.',',',$preco->preco_original);
                      			$pos = strpos($preco->preco_original, '.');
                      			$zero = strlen(substr($preco->preco_original, $pos + 1));
                      			if(strlen($zero)==1){
                      			echo "0";
                      			}
                      ?>" 
                      readonly>
                    </label>

                    <label style="font-weight: 600;" for="produto">Preço Final
                      <input type="text" style="box-shadow: 3px 3px 3px 0px #888888; 
                      width: 
                      <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "200px";
                        } elseif ($detect->isTablet()) {
                            echo "200px";
                        } else {
                            echo "244.5px";
                        } 
                      ?>" class="form-control" id="FN" name="fn" value=
                      "<?php 
                      		echo "R$ ".str_replace('.',',',$preco->preco_final);
                      		$pos = strpos($preco->preco_final, '.');
                      		$zero = strlen(substr($preco->preco_final, $pos + 1));
                      		if(strlen($zero)==1){
                      			echo "0";
                      		}
                      ?>" 
                      readonly>
                    </label>
                       
                <label style="font-weight: 600;" for="produto">Tamanho
                    <input type="text" 
                    style="box-shadow: 3px 3px 3px 0px #888888; 
                    width: <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "200px";
                        } elseif ($detect->isTablet()) {
                            echo "200px";
                        } else {
                            echo "244.5px";
                        } 
                      ?>" 
                    class="form-control" 
                    id="FN" 
                    name="fn" 
                    value="{{$consultas->tamanho}}" 
                    readonly>
                    </label>

                    <label style="font-weight: 600;" for="produto">Cor
                    <input type="text" 
                    style="box-shadow: 3px 3px 3px 0px #888888; 
                    width: 
                      <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "200px";
                        } elseif ($detect->isTablet()) {
                            echo "200px";
                        } else {
                            echo "244.5px";
                        } 
                      ?>" 
                    class="form-control" 
                    id="FN" 
                    name="fn" 
                    value="{{$consultas->cor}}" 
                    readonly>
                    </label>

                                
                <label style="font-weight: 600;" for="produto">Descrição do Grupo
                  <input type="text" 
                  style="box-shadow: 3px 3px 3px 0px #888888; 
                  width: 
                      <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "200px";
                        } elseif ($detect->isTablet()) {
                            echo "200px";
                        } else {
                            echo "244.5px";
                        } 
                      ?>" class="form-control" id="DS_GRU" name="descricaogrupo" value="{{$consultas->ds_grupo}}" readonly>
                </label>

                <label style="font-weight: 600;" for="produto">Saldo Físico
                    <input type="text" 
                    style="box-shadow: 3px 3px 3px 0px #888888; 
                    width: 
                    <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "200px";
                        } elseif ($detect->isTablet()) {
                            echo "200px";
                        } else {
                            echo "244.5px";
                        } 
                      ?>;" class="form-control" id="FN" name="fn" value="{{$consultas->vl_saldo_fisico}}" 
                    readonly>
                  </label>
		  @endif

		  @if(Cookie::get('nome')=='DPA')
		  <label style="font-weight: 600; font-size: 20px;" for="produto">Descrição do Produto
                  <textarea class="form-control" id="DS_PROD" name="descricaoproduto" 
    		  style="box-shadow: 3px 3px 3px 0px #888888; 
            	  width: 
            	  <?php 
            	  // Cria uma inst�ncia de MobileDetect
            	  $detect = new MobileDetect;

            	  // Verifica se � um dispositivo m�vel
            	  if ($detect->isMobile()) {
                	echo "200px";
            	  } elseif ($detect->isTablet()) {
                	echo "200px";
            	  } else {
                	echo "492px";
            	  } 
            	  ?>; 

            	  max-width: 
            	  <?php 
            	  // Cria uma inst�ncia de MobileDetect
            	  $detect = new MobileDetect;

            	  // Verifica se � um dispositivo m�vel
            	  if ($detect->isMobile()) {
                	echo "200px";
            	  } elseif ($detect->isTablet()) {
                	echo "200px";
            	  } else {
                	echo "492px";
            	  } 
            	  ?>;

            	  height: 120px;
            	  min-height: 60px;
            	  font-size: 20px;
            	  padding: 12px;
            	  line-height: 1.5;
            	  font-weight: 500;
            	  word-wrap: break-word;
            	  word-break: break-word;
            	  white-space: pre-wrap; /* Mant�m espa�os e quebras */
            	  resize: vertical; /* Permite redimensionar */
            	  overflow: auto;"  
  	    	  readonly>{{$consultas->ds_descricao}}</textarea>

                  </label>


		   <label style="font-weight: 600; font-size: 20px;" for="produto">Refer&ecirc;ncia
                  <textarea class="form-control" id="DS_PROD" name="descricaoproduto" 
    		  style="box-shadow: 3px 3px 3px 0px #888888; 
            	  width: 
            	  <?php 
            	  // Cria uma inst�ncia de MobileDetect
            	  $detect = new MobileDetect;

            	  // Verifica se � um dispositivo m�vel
            	  if ($detect->isMobile()) {
                	echo "200px";
            	  } elseif ($detect->isTablet()) {
                	echo "200px";
            	  } else {
                	echo "492px";
            	  } 
            	  ?>; 

            	  max-width: 
            	  <?php 
            	  // Cria uma inst�ncia de MobileDetect
            	  $detect = new MobileDetect;

            	  // Verifica se � um dispositivo m�vel
            	  if ($detect->isMobile()) {
                	echo "200px";
            	  } elseif ($detect->isTablet()) {
                	echo "200px";
            	  } else {
                	echo "492px";
            	  } 
            	  ?>;

            	  height: 60px;
            	  min-height: 60px;
            	  font-size: 20px;
            	  padding: 12px;
            	  line-height: 1.5;
            	  font-weight: 500;
            	  word-wrap: break-word;
            	  word-break: break-word;
            	  white-space: pre-wrap; /* Mant�m espa�os e quebras */
            	  resize: vertical; /* Permite redimensionar */
            	  overflow: auto;"  
  	    	  readonly>{{$consultas->ds_grupo}}</textarea>

                  </label>

		  <label style="font-weight: 600; font-size: 20px;" for="produto">Local
                  <textarea class="form-control" id="DS_PROD" name="descricaoproduto" 
    		  style="box-shadow: 3px 3px 3px 0px #888888; 
            	  width: 
            	  <?php 
            	  // Cria uma inst�ncia de MobileDetect
            	  $detect = new MobileDetect;

            	  // Verifica se � um dispositivo m�vel
            	  if ($detect->isMobile()) {
                	echo "200px";
            	  } elseif ($detect->isTablet()) {
                	echo "200px";
            	  } else {
                	echo "492px";
            	  } 
            	  ?>; 

            	  max-width: 
            	  <?php 
            	  // Cria uma inst�ncia de MobileDetect
            	  $detect = new MobileDetect;

            	  // Verifica se � um dispositivo m�vel
            	  if ($detect->isMobile()) {
                	echo "200px";
            	  } elseif ($detect->isTablet()) {
                	echo "200px";
            	  } else {
                	echo "492px";
            	  } 
            	  ?>;

            	  height: 60px;
            	  min-height: 60px;
            	  font-size: 20px;
            	  padding: 12px;
            	  line-height: 1.5;
            	  font-weight: 500;
            	  word-wrap: break-word;
            	  word-break: break-word;
            	  white-space: pre-wrap; /* Mant�m espa�os e quebras */
            	  resize: vertical; /* Permite redimensionar */
            	  overflow: auto;"  
  	    	  readonly>{{$consultas->local}}</textarea>

                  </label>

		  @endif
                  </div>
                  @endonce
                @endif

              @endforeach

              <div 
              class="
              <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "form-group col-4";
                        } elseif ($detect->isTablet()) {
                            echo "form-group col-4%";
                        } else {
                            echo "form-group col-8";
                        } 
              ?>;" 
              style="max-width: 
              <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if ($detect->isMobile()) {
                            echo "62%";
                        } elseif ($detect->isTablet()) {
                            echo "62%";
                        } else {
                            echo "55%";
                        } 
              ?>;">
              
              <!-- Tabela-->
              @once
              <hr style="height:2px; visibility:hidden; margin-bottom: -7px;"></hr>
              <table style="margin-left: auto; margin-right: auto; top: -10px; text-align: center; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2); width: 162%;">
                <thead>

                  <tr>
                    <?php $tamanhoAnterior=array();?>
                    <th><!-- Intentionally Blank --></th>
                    @foreach ($tabela as $categoria)
                      <?php 
                      if($categoria->tamanho!=$tamanhoAnterior){
                        echo "<th style='border: 1px solid; background: rgb(244,121,123); color: white; width: 10%;'>";
                        echo $categoria->tamanho;
                        echo "</th>";
                      }
                      $tamanhoAnterior=$categoria->tamanho;
                      ?>

                    @endforeach
                  <tr>

                </thead>
                <tbody>
                  @php
                      $saldofisico = array();
                  @endphp

                  <tr>
                    <?php $coresExibidas = array();?>
                    @foreach ($tabela as $categoria)
                        @if($categoria->cd_empresa == $limitacao)
                            @if(!isset($saldofisico[$categoria->tamanho]))
                                <?php
                                    $saldofisico[$categoria->tamanho] = [];
                                ?>
                            @endif

                            @if(!isset($saldofisico[$categoria->tamanho][$categoria->cor]))
                                <?php
                                    $saldofisico[$categoria->tamanho][$categoria->cor] = 0;
                                ?>
                            @endif

                            <?php
                                $saldofisico[$categoria->tamanho][$categoria->cor] += $categoria->vl_saldo_fisico;
                            ?>
                        @endif
                    @endforeach

                    @foreach ($tabela as $categoria)
                    <?php 
                        if(!in_array($categoria->cor, $coresExibidas)) {
                            echo "<tr>";
                            echo "<td style='border: 1px solid; background: rgb(244,121,123); color: white; width: 10%;'>";
                            echo $categoria->cor;
                            echo "</td>";

                            $tamanhosUnicos = array_unique(array_column($tabela, 'tamanho'));

                            foreach ($tamanhosUnicos as $tamanho) {
                                // Verifica se a chave para o tamanho e a cor existe antes de exibir o valor
                                if (isset($saldofisico[$tamanho][$categoria->cor])) {
                                    echo '<td style="border: 1px solid; width: 10%; background-color: white;">' . ($saldofisico[$tamanho][$categoria->cor]) . '</td>';
                                } else {
                                    // Se a chave não existir, exibe um valor padrão (por exemplo, 0 ou vazio)
                                    echo '<td style="border: 1px solid; width: 10%; background-color: white;">0</td>';
                                }
                            }

                            echo "</tr>";
                            array_push($coresExibidas, $categoria->cor);
                        }
                    ?>
                    @endforeach
                  </tr>

                </tbody>
              </table>
	      <br>
              @endonce
          <!-- Fim da tabela-->
        </div>


        </div>
        @isset($isDesktop)
        @if($isDesktop)
          @once       
            <div >
              <form action="/consultarbarra" method="GET" id="form1">
              @csrf
              <div class="form-group" style="margin-left: auto; margin-right: auto; text-align:center; font-weight: 600;">
                  <label for="codigo">Código de barras</label>
                  <input type="text" class="form-control" id="Codigo" name="codigo" placeholder="Informe o código de barras." style="margin-left: auto; margin-right: auto; text-align:center; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" oninput="agendarEnvio(this.value)" 
                  <?php 
                        // Cria uma instância de MobileDetect
                        $detect = new MobileDetect;

                        // Verifica se é um dispositivo móvel
                        if (!$detect->isMobile() || !$detect->isTablet()) {
                            echo "autofocus required";
                        }
                  ?>>
                  <input type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$limitacao}}">
              </div>
              <br>
          </form>

                <div class="form-group" style=" top: 12em; left: 17em; text-align:center;">
                  <label for="opcao" style="font-weight: bold;">OU</label>
                  <br></br>
                </div>

                <form action="/consultar" method="GET">
                  @csrf
                  <div style="display:flex;
                        justify-content: center;
                        align-items: center;
                        gap: 20px;
                        flex-direction: column;
                        height: 150px;">
                    <label for="códigoPD" style="font-weight: 600;" class="label-np">Referência</label>
                    <ul>
                      <div style="display: inline-flex;">
                        <input style="text-align: center; width: 30px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS1" name="codigods1" maxlength="1" required>
                        <input style="text-align: center; width: 40px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS2" name="codigods2" maxlength="2" required>
                        <input style="text-align: center; width: 40px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS3" name="codigods3" maxlength="2" required>
                        <input style="text-align: center; width: 30px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS4" name="codigods4" maxlength="1" required>
                        <input style="text-align: center; width: 70px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS5" name="codigods5" maxlength="4" required>
                        <input style="text-align: center; width: 2px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$limitacao}}">
                      </div>
                    </ul>
                    <p><button type="submit" class="btn btn-primary" style="top: -50px">Pesquisar</button></p>
                  </div>
                  <br> 
                </form>
            </div>
        </div>
        @endonce
        @endif
        @endisset

      </form>

      @empty
      <div class="alert alert-warning" role="alert">
        Não há dados no banco de dados!
      </div>
      @endforelse

      @if(Cookie::get('nome')!='DPA')
      <form action="/estoques" method="GET">
        <hr style="height:2px; visibility:hidden; margin-bottom: -12px;"></hr>
        <input type="hidden" class="form-control" id="DS_GRU" name="descricaogrupo" value="{{$consultas->ds_grupo}}" readonly>
        <input type="hidden" class="form-control" id="loja" name="loja" value="{{$loja->loja}}" readonly>
        <button type="submit" class="btn btn-primary" style="display: grid;
          place-items: center; margin-left: auto; margin-right: auto; top: 15px;">Estoques</button>
      </form>
      @endif

      </div>

      </form>

      @empty($isDesktop)
          @once
          <br>
            <div style="display:block;">
              <form action="/consultarbarra" method="GET" id="form1">
              @csrf
              <div class="form-group" style="margin-left: auto; margin-right: auto; text-align:center; font-weight: 600;">
                  <label for="codigo">Código de barras</label>
                  <input type="text" class="form-control" id="Codigo" name="codigo" placeholder="Informe o código de barras." style="margin-left: auto; margin-right: auto; text-align:center; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" oninput="agendarEnvio(this.value)" autofocus required>
                  <input type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$limitacao}}">
              </div>
              <br>
          </form>

                <div class="form-group" style=" top: 12em; left: 17em; text-align:center;">
                  <label for="opcao" style="font-weight: bold;">OU</label>
                  <br></br>
                </div>

                <form action="/consultar" method="GET">
                  @csrf
                  <div style="display:flex;
                        justify-content: center;
                        align-items: center;
                        gap: 20px;
                        flex-direction: column;
                        height: 150px;">
                    <label for="códigoPD" style="font-weight: 600;" class="label-np">Referência</label>
                    <ul>
                      <div style="display: inline-flex;">
                        <input style="text-align: center; width: 30px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS1" name="codigods1" maxlength="1" required>
                        <input style="text-align: center; width: 40px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS2" name="codigods2" maxlength="2" required>
                        <input style="text-align: center; width: 40px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS3" name="codigods3" maxlength="2" required>
                        <input style="text-align: center; width: 30px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS4" name="codigods4" maxlength="1" required>
                        <input style="text-align: center; width: 70px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="text" class="form" id="CodigoDS5" name="codigods5" maxlength="4" required>
                        <input style="text-align: center; width: 2px; margin-right: 5px; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$limitacao}}">
                      </div>
                    </ul>
                    <p><button type="submit" class="btn btn-primary" style="top: -50px">Pesquisar</button></p>
                  </div>
                  <br> 
                </form>
            </div>
        </div>
        @endonce
        @endempty


      </div>

      <form action="/consultarbarra" method="GET" id="form2" style="display: none">
          @csrf
          <div class="form-group" style="margin-left: auto; margin-right: auto; text-align:center; font-weight: 700;">
            <label for="código">Código de barras</label>
            <input type="text" class="form-control" id="CodigoHidden" name="codigo" placeholder="Informe o código de barras." style="margin-left: auto; margin-right: auto; text-align:center; width:100%; box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);" required>
            <input type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$limitacao}}">
          </div>
          <br>
      </form>


      <br></br>

      <script>
          let timeoutId;

          window.onpageshow = function() {
            document.getElementById('Codigo').value = '';
            document.getElementById('CodigoDS1').value = '';
            document.getElementById('CodigoDS2').value = '';
            document.getElementById('CodigoDS3').value = '';
            document.getElementById('CodigoDS4').value = '';
            document.getElementById('CodigoDS5').value = '';
          };

          function agendarEnvio(valor) {
              // Limpar o timeout anterior, se houver
              clearTimeout(timeoutId);

              // Copiar o valor do primeiro input para o segundo input escondido
              document.getElementById('CodigoHidden').value = valor;

              // Agendar o envio do formulário após meio segundo
              timeoutId = setTimeout(function() {
                  document.getElementById('form2').submit();
              }, 500);
          }

      </script>

   <script>
     document.addEventListener('DOMContentLoaded', function() {
       const inputs = [
           document.getElementById('CodigoDS1'),
           document.getElementById('CodigoDS2'),
           document.getElementById('CodigoDS3'),
           document.getElementById('CodigoDS4'),
           document.getElementById('CodigoDS5')
       ];

       // Adiciona o event listener para cada input
       inputs.forEach((input, index) => {
           input.addEventListener('input', function() {
               // Verifica se atingiu o limite de caracteres
               if (this.value.length === parseInt(this.maxLength)) {
                   // Move para o pr�ximo input se existir
                   if (index < inputs.length - 1) {
                       inputs[index + 1].focus();
                   }
               }
           });

           // Adiciona suporte para tecla Backspace
           input.addEventListener('keydown', function(e) {
               if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                   inputs[index - 1].focus();
               }
           });
       });
   });
   </script>


@endsection
