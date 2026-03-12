@extends('layouts.layout-sistema')
@section('titulo','Consulta de saldo')
@section('conteudo')

    <!-- inicio -->
    <div class="container">
        <!-- cabeçalho -->
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Consulta de saldo de troca</h1>
                <a class="btn btn-primary" href="/saldo" role="button">Retornar ao Inicio</a>
            </div>
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
        </div>
        <!-- tabela de dados -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Pessoa</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>  
            @foreach($autorizadas as $registro)
            <tbody>
                <tr>
                    <td>{{ $registro->id }}</td>
                    <td>{{ $registro->created_at }}</td>
                    <td>{{ $registro->pessoa }}</td>
                    <td>{{ $registro->nome }}</td>
                    <td>R$ {{ number_format($registro->valor / 100, 2, ',', '.') }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>    
    </div>
    <!-- final -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  @endsection