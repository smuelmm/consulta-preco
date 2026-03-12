@extends('layouts.layout-estoques')
@section('titulo','Consulta feita')
@section('conteudo')
<?php 
// Inclui o autoloader do Composer
use Detection\MobileDetect;
?>
<link rel="stylesheet" type="text/css" href="css/app.css">
<div class="form-group col-md-4.5" style="display: inline-block;">
  <p class="h3 text-primary">Consulta de preço</p>
</div>
<div style="display: inline-block;">
    <button onclick="history.back()" type="button" style="display: inline-block; 
    margin-left:
    <?php 
    // Cria uma instância de MobileDetect
    $detect = new MobileDetect;

    // Verifica se é um dispositivo móvel
    if ($detect->isMobile()) {
      echo "45%";
    } elseif ($detect->isTablet()) {
      echo "95%";
    } else {
      echo "1075%";
    } 
    ?>" class="btn btn-primary btn-lg btn-block">Voltar</button>
</div>
<hr>

  <form class="form-group col-md-4.5" style="vertical-align:middle; align-items: center;">
    
  <!--LOJAS-->
  @foreach($lojas as $loja)
    <table style="margin-left: 
      <?php 
      // Cria uma instância de MobileDetect
      $detect = new MobileDetect;

      // Verifica se é um dispositivo móvel
      if ($detect->isMobile()) {
        echo "70px";
      } elseif ($detect->isTablet()) {
        echo "70px";
      } else {
        echo "105px";
      } 
      ?>; margin-right: auto; top: -10px; text-align: center; display: inline-block; 
      width:
      <?php 
      // Cria uma instância de MobileDetect
      $detect = new MobileDetect;

      // Verifica se é um dispositivo móvel
      if ($detect->isMobile()) {
        echo "60%";
      } elseif ($detect->isTablet()) {
        echo "60%";
      } else {
        echo "23%";
      } 
      ?>;
      <?php
      if($loja->loja == $Aloja){
        echo "border: 5px outset gray;";
      }
      ?>
      ">
      <caption style="text-align:center; color:black; font-size: 12px"><?php 
      $var = $loja->loja;
      $posicaoLoja = strpos($var, 'COLMEIA ');
      if ($posicaoLoja !== false) {
          // Insere <br> após a palavra "loja"
          $novoTexto = substr_replace($var, '<br>', $posicaoLoja + 7, 0);
          echo $novoTexto;
      } else {
          echo "A palavra 'COLMEIA ' não foi encontrada.";
      }
      ?> 
      </caption>
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
            @if(isset($saldofisico[$categoria->tamanho][$categoria->cor]) and $categoria->cd_empresa==$loja->cd_loja)
                <?php
                    $saldofisico[$categoria->tamanho][$categoria->cor] += $categoria->vl_saldo_fisico;
                ?>
            @elseif($categoria->cd_empresa==$loja->cd_loja)
                <?php
                    $saldofisico[$categoria->tamanho][$categoria->cor] = $categoria->vl_saldo_fisico;
                ?>
            @endif
          @endforeach

          @foreach ($tabela as $categoria)
          <?php 
              if(!in_array($categoria->cor, $coresExibidas)){
              echo "<tr>";
              echo "<td style='border: 1px solid; background: rgb(244,121,123); color: white; width: 10%; font-size: 15px'>";
              echo $categoria->cor;
              echo "</td>";

              $tamanhosUnicos = array_unique(array_column($tabela, 'tamanho'));

              foreach ($tamanhosUnicos as $tamanho) {
                if (isset($saldofisico[$tamanho][$categoria->cor])) {
                    echo '<td style="border: 1px solid; width: 10%; background-color: white;">' . $saldofisico[$tamanho][$categoria->cor] . '</td>';
                } else {
                    // Se o índice não existir, imprime um valor padrão ou faz algo adequado à sua lógica
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
    @endforeach
  </form>
@endsection