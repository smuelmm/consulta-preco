<!doctype html>
<?php 
// Inclui o autoloader do Composer
use Detection\MobileDetect;
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>
    <link rel="icon" type="image/png" href="boxes.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,700&family=Rubik:ital,wght@1,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--INICIAR PROJETO CMD= php artisan serve
          618 
          91517
  -->
    <style>
      body, html {
        margin: 0;
        font-family: 'Noto Sans', sans-serif;
        background: #D5D5D5;
        height: 100%;
      }

      body * {
        box-sizing: border-box;
      }

      header {
        /*margin-top: 3em;*/
        position: fixed;
        width: 100%;
        height: 4rem;
        align-items: center;
        justify-content: center;
        z-index: 101;
        background: rgb(253,136,136);
      }

      header ul {
        display: flex;
        align-items: center;
        justify-content: center;
      }

      header ul h1 {
        color: white;
        letter-spacing: 1px;
        text-decoration: none;
        font-size: 3em;
      }

      .icon {
            background-repeat: no-repeat;
            background-size: contain;
            width: 20px;
            height: 20px;
        }
        .show-password {
            background-image: url('show.png');
        }
        .hide-password {
            background-image: url('hide.png');
        }

      .main-login {
        width: 100vw;
        height: 100vh;
        background: whitesmoke;
        display: flex;
        flex-direction: row;
        align-items: center;
      }

      .left-login{
        /*background: red;*/
        width: 50%;
        display: flex;
        justify-content: center;
        padding-left: 20%;
        flex-direction: column;
      }

      .left-login-image {
          width: 20vw;
      }

      .left-login > h1 {
        font-size: 3vw;
      }

      .right-login {
        /*background: blue;*/
        width: 100%;
        display: flex;
        align-items: center;
        padding-left: 10%;
      }

      .card-login {
        width: 25em;
        height: 27em;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 30px 35px;
        border-radius: 20px;
        background: rgb(244,121,123);
        box-shadow: 0px 10px 40px #00000056;
        padding-bottom: 15px;
      }

      .card-login > h1 {
        color: white;
        font-family: "Rubik", sans-serif;
        font-optical-sizing: auto;
        font-weight: 600;
        font-style: italic;
        margin: 0;
      }

      .textfield {
        position: relative;
        width: 100%;
        height: 45%;
        margin: 0px 0px;
      }

      .textfield > input {
        position: absolute;
        top: 3em;
        left: 0;
        width: 100%;
        height: 40%;
        border: none;
        border-radius: 20px;
        padding: 0 20px;
        background: white;
        color: black;
        font-size: 12pt;
        box-shadow: 0px 10px 30px #00000056;
        outline: none;
        box-sizing: border-box;
      }

      .textfield > label {
        color: white;
        margin-bottom: 10px;
        margin-top: 15px;
        margin-left: 8px;
        font-family: "Poppins", sans-serif;
        font-weight: 700;
        font-style: italic;
        font-size: 15px;
      }

      .icon {
        position: absolute;
        top: 58%; right: 20px;
        transform: translateY(-50%);
        background: url("show.png");
        background-size: cover;
        width: 30px;
        height: 30px; cursor: pointer;
      }

      .icon.hide{
        background: url("hide.png");
        background-size: cover;
      }

      .bottom-login {
        display: flex;
      }

      .btn-login {
        width: 8em;
        height: 2.5em;
        margin: 7px;
        margin-top: 1.5em;
        border: none;
        border-radius: 8px;
        outline: none;
        text-transform: uppercase;
        font-weight: 800;
        white-space: 3px;
        color: black;
        background: white;
        cursor: pointer;
        box-shadow: 0px 10px 40px -12px rgb(244,121,123);
        margin-bottom: 20px;
      }

      .pass-icon{
        cursor: pointer;
      }

      @media only screen and (min-width: 621px) and (max-width: 800px) {
  .main-login {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    /* background: orange; */
  }

  .left-login {
    display: flex;
    width: 100%;
    height: 75px;
    justify-content: center;
    padding-left: 38%;
    margin-top: 40px;
    margin-bottom: 40px;
    /* background: green; */
  }

  .left-login-image {
    width: 10em;
    /* background: red; */
  }

  .right-login {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10%;
  }

  .card-login {
    width: 25em;
    height: 27em;
    padding: 20px;
    width: 100% auto;
  }

  .textfield {
    margin-bottom: 15px;
  }
}

@media only screen and (max-width: 620px) {
  .main-login {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    /* background: orange; */
  }

  .left-login {
    display: flex;
    width: 100%;
    height: 75px;
    justify-content: center;
    padding-left: 31%;
    margin-top: 40px;
    margin-bottom: 40px;
    /* background: green; */

  }

  .left-login-image {
    width: 10em;
    /* background: red; */
  }

  .right-login {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right:10%;
  }

  .card-login {
    padding: 20px;
    width: 100% auto;
  }

  .textfield {
    margin-bottom: 15px;
  }
}


      /*#icon{
        position: absolute;
        top: 50%;
        right: 20%;
        transform: translateY(-50%);
        background: url('public/eye.png');
        background-size: cover;
        width: 30px;
        height: 30px;
        cursor: pointer;
      }
      */
      /*@media only screen and (max-width: 1280px){

    .card-login{
        width: 80%;
        height: auto;
    }

    .left-login-image{
      padding-left: 20%;
    }

    .rigth-login > .card.login{
      width: 80%;
      height: auto;
    }

}

@media only screen and (max-width: 720px){
    .main-login{
        flex-direction: column;
        height: 100%;
        width: 101%;
        margin-top: 10em;
    }
    .left-login > h1{
        display: none;
    }

    .left-login{
        width: 100%;
        height: auto;
    }
    .rigth-login{
        width: 100%;
        height: auto;

    }
    .left-login > .left-login-image{
        width: 40vh;
    }
    .card-login{
        width: 100%;
        height: auto;
    }
    .left-login-image{
      display:none;
    }
    header {
      margin-top: -8em;
      position: fixed;
      width: 100%;
      height: 4rem;
      align-items: center;
      justify-content: center;
      z-index: 101;
      background: rgb(244,121,123);
    }

}*/


    </style>
  </head>

  <body>
            @yield('conteudo')
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
      var a = {};

        function pass(cdv cdp) {
            if (a[cdv cdp] === 1) {
                document.getElementById(cdv cdp).type = 'password';
                document.getElementById('pass' + cdv cdp).src = '/eye-off.png';
                a[cdp cdv] = 0;
            } else {
                document.getElementById(cdp cdv).type = 'text';
                document.getElementById('pass' + cdp cdv).src = '/eye.png';
                a[cdp cdv] = 1;
        }
      }
    </script>

  </body>
</html>