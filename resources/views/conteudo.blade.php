<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Conteúdo MKT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"> 
    </head>
    <body>
        <!-- inicio -->
        <div class="container">
            <h1>Registro de Conteúdo</h1> 
            <hr>
            <!-- área de avisos -->     
            @if(session('msg')) 
                <div class="row">
                    <div class="alert alert-warning" role="alert">
                        <div class="d-flex justify-content-center">{{session('msg')}}</div>
                    </div>
                </div>
                <br>
            @endif
            <!-- área do formulário -->
            <div class="row">
                <form action="/conteudo" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referência</label>
                        <input type="text" 
                            class="form-control" 
                            id="referencia" 
                            name="referencia" 
                            aria-describedby="referenciaHelp"
                            required 
                            autofocus
                             pattern="[C0-9][0-9]{0,9}"
                            maxlength="10">
                        <div id="referenciaHelp" class="form-text">
                            Deve iniciar com a letra C (opcional) e conter até 10 caracteres no total.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text"
                            class="form-control"
                            id="url"
                            name="url"
                            aria-describedby="UrlHelp"
                            required>
                        <div id="UrlHelp" class="form-text">URL do conteúdo</div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-database-down"></i> Gravar</button> 
                    <a class="btn btn-primary" href="/conteudoConsulta" role="button"><i class="bi bi-search"></i> Listar</a>
                    <a class="btn btn-primary" href="/upload" role="button"><i class="bi bi-cloud-upload"></i> Carregar de arquivo</a>
                </form> 
            </div>

            <!--area da consulta com paginação -->
            @if($registros->count() > 0)
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Referência</th>
                                <th>Url</th>
                                <th>Del</th>
                                <th>Teste</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $registro)
                                <tr>
                                    <td>{{ $registro->id }}</td>
                                    <td>{{ $registro->referencia }}</td>
                                    <td>{{ $registro->url }}</td>
                                    <td><a href="/conteudoDel/{{ $registro->id }}"><i class="bi bi-trash"></i></a></td>
                                    <td><a href="/mv/{{ $registro->referencia }}"><i class="bi bi-caret-right-square"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- paginação -->
                <div class="d-flex justify-content-center">
                    {{ $registros->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
        <!-- fim -->
    </body>
</html>
