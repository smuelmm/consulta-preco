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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body style="background-color: whitesmoke; ">
    <main>
      <div class="container-sm mt-3" style="background-color: whitesmoke; border-radius: 15px; height: auto; ">
        <!-- navbar -->  
        <div class="row" style="background-color: rgba(245,245,245,0.9); border-radius: 15px;"> 
          <div class="col-sm-12" style="background-color: rgba(245,245,245,0.9); border-radius: 15px;"> 
            <nav class="navbar" style="background-color: rgb(244,121,123); border-radius: 15px;">
              <div class="col-sm-11" style="background-color: rgb(244,121,123); border-radius: 15px; 
              <?php 
                // Cria uma instância de MobileDetect
                $detect = new MobileDetect;

                // Verifica se é um dispositivo móvel
                if ($detect->isMobile()) {
                    echo "width: 300px";
                } elseif ($detect->isTablet()) {
                    echo "width: 300px";
                } 
                ?>">
                <a class="navbar-brand" style="color:white; font-weight: bold;"><img src="/logopreta.png" class="rounded" alt="logo" style="width:8%;height:5%; margin-left: 10px; "> Moda Colmeia</a>
              </div>  
	    	      
              <div class="col-sm-1 d-flex align-items-center justify-content-between" style="background-color: rgb(244,121,123); border-radius: 15px;">
		<a href="/saldo" class="btn btn-primary me-2" style="font-size: 0.75em; min-width: 75px;">Saldo<br>de troca</a>
                <a class="navbar-brand"  href="/"><ion-icon name="log-out-outline"></ion-icon></a>  
              </div>
            </nav>          
          </div>
        </div> 

        <!-- corpo -->
        <div class="row"> 
          <div class="col-sm-12 mt-4"> 

            @yield('conteudo')

          </div>  
        </div> 

        <!-- botão voltar parte inferior -->
        <hr>

        <!-- rodapé -->
        <hr>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  </body>
</html>