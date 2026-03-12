@extends('layouts.layout-sistema')
@section('titulo','Consulta de pre莽o')
@section('conteudo')

<div>
  <div style="color: rgb(13, 110, 253, 1.0); text-align: center;">
          @foreach($loja as $loja)
          <p class="h3">Consulta <?php

	  if(Cookie::get('nome')!='DPA'){
		echo "pre&ccedil;o";
	  }
	  ?>:
 <?php 
          $pos = strpos($loja->loja, '- ');
          $novaString = substr($loja->loja, $pos + strlen('- '));
          echo $novaString;
          ?>
          </p>
          @endforeach
        </div>

      </div> 
</div>
<div>
  <div style="text-align:center;">
    <form action="/consultarbarra" method="GET" id="form1">
      @csrf
      <div>
        <label for="c贸digo" style="text-align: center">C贸digo de barras</label>
        <div class="input-container">
          <input type="text" class="form-control" id="Codigo" name="codigo" placeholder="Informe o c贸digo de barras." style="margin-left: auto; margin-right: auto; text-align:center" oninput="agendarEnvio()" autofocus required>
          <input type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$dados->cd_loja}}">
        </div>
      </div>
    </form>
    <br>

    <div id="resultado"></div>

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

        function agendarEnvio() {
            // Limpar o timeout anterior, se houver
            clearTimeout(timeoutId);

            // Agendar o envio do formul谩rio ap贸s meio segundo
              timeoutId = setTimeout(function() {
                  document.getElementById('form1').submit();
              }, 500);
        }

    </script>
      <div class="sep-ou">
        <label for="opcao" style="font-weight: bold;">OU</label>
      </div>

    <br>

    <form action="/consultar" method="GET">
      @csrf
      <div>
          <label>Refer锚ncia</label>
        <ul>
          <input type="text" class="form" id="CodigoDS1" name="codigods1" maxlength="1" style="width: 30px; text-align: center;" required>
          <input type="text" class="form" id="CodigoDS2" name="codigods2" maxlength="2" style="width: 40px; text-align: center;"required>
          <input type="text" class="form" id="CodigoDS3" name="codigods3" maxlength="2" style="width: 40px; text-align: center;"required>
          <input type="text" class="form" id="CodigoDS4" name="codigods4" maxlength="1" style="width: 30px; text-align: center;"required>
          <input type="text" class="form" id="CodigoDS5" name="codigods5" maxlength="4" style="width: 70px; text-align: center;"required>
          <input type="hidden" class="form-control" id="Empresa" name="cdempresa" value="{{$dados->cd_loja}}">
      </ul>
      
        <p><button type="submit" class="btn btn-primary" style="top: -50px">Pesquisar</button></p>
      </div>

      
    </form>

    <script>
        window.onpageshow = function() {
        document.getElementById('Codigo').value = '';
        document.getElementById('CodigoDS1').value = '';
        document.getElementById('CodigoDS2').value = '';
        document.getElementById('CodigoDS3').value = '';
        document.getElementById('CodigoDS4').value = '';
        document.getElementById('CodigoDS5').value = '';
        };
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
                   // Move para o pr髕imo input se existir
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
  </div>
</div>
<br>
<br>
<div style="text-align:center;">
  <p><a href="/saldo" class="btn btn-primary" style="top: -50px">Pesquisar Saldo de troca do cliente</a></p>
</div>

@endsection