@extends('layouts.layout-login')
@section('titulo','Consulta de preço')
@section('conteudo')

<form action="/login" method="POST">
  @csrf
  <header>
        <ul>
          <!--<h1>CONSULTA PREÇO</h1>-->
        </ul>
    </header>

<div class="main-login">
        <div class="left-login">
            <img src="/logopreta.png" class="left-login-image" alt="logo"></a>
        </div>

        <div class="right-login">
            <div class="card-login">
                <h1>Login</h1>
                <div class="textfield">
                    <label for="código">CÓDIGO DE VENDEDOR</label>
                    <input id="CDV" class="password" name="cdv" type="text" placeholder="Digite seu código de vendedor" required>
                    <div id="icon1"  onclick="showHide('CDV', 'icon1')"></div>
                </div>
                <div class="textfield">
                    <label for="código">CÓDIGO DE PESSOA</label>
                    <input id="CDP" class="password" name="cdp" type="password" placeholder="Digite seu código de pessoa" required>
                    <div id="icon2" class="icon" onclick="showHide('CDP', 'icon2')"></div>
                </div>
                <div class="bottom-login">
                    <button type="submit" class="btn-login btn btn-primary">ENTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Começa com o olho fechado
        document.addEventListener("DOMContentLoaded", function() {
            const icon1 = document.getElementById('icon1');
            const icon2 = document.getElementById('icon2');
            
            icon1.style.backgroundImage = "url('hide.png')";
            icon2.style.backgroundImage = "url('hide.png')";
        });

        function showHide(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.setAttribute('type', 'text');
                icon.style.backgroundImage = "url('show.png')";
            } else {
                passwordInput.setAttribute('type', 'password');
                icon.style.backgroundImage = "url('hide.png')";
            }
        }
    </script>
    {!! isset($script) ? $script : '' !!}
@endsection