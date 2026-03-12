@extends('layouts.layout-sistema')
@section('titulo','Consulta de saldo')
@section('conteudo')
    <!-- inicio -->
    <div class="container">
        <!-- cabeçalho -->
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Consulta de saldo de troca</h1>
                <a class="btn btn-primary" href="/saldoautorizadas" role="button">Autorizadas</a>
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

        <!-- bloco de pesquisa -->
        <div class="row">
            <div class="col">
                <!-- por cd_pessoa -->
                <form method="GET" action="/saldoid">
                @csrf    
                <div class="mb-3">
                    <label for="cdpessoa" class="form-label">ID (cd_pessoa)</label>
                    <input type="number" class="form-control" id="cdpessoa" name="cdpessoa" aria-describedby="cdpessoaHelp">
                    <div id="cdpessoaHelp" class="form-text">Consulta pelo <strong>código</strong> do cliente.</div>
                </div>
                <button type="submit" class="btn btn-primary">Consultar</button>
                </form>            
            </div>
            <div class="col">
                <!-- por cpf ou cnpj -->
                <form method="GET" action="/saldocpf">
                @csrf    
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF/CNPJ</label>
                    <input type="number" class="form-control" id="cpf" name="cpf" aria-describedby="cpfHelp">
                    <div id="cpfHelp" class="form-text">Consulta pelo <strong>CPF ou CNPJ</strong> do cliente.</div>
                </div>
                <button type="submit" class="btn btn-primary">Consultar</button>
                </form>                        
            </div>
            <div class="col">
                <!-- por parte do nome -->
                <form method="GET" action="/saldonome">
                @csrf    
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nomeHelp">
                    <div id="nomeHelp" class="form-text">Consulta pelo <strong>nome</strong> do cliente.</div>
                </div>
                <button type="submit" class="btn btn-primary">Consultar</button>
                </form>                                    
            </div>
        </div>
        <hr>
        
        <!-- resultado pesquisa -->
        @if($tabela->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Fone</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>        
                @foreach($tabela as $registro)
                <tbody>
                    <tr>
                        <td>{{ $registro->id }}</td>
                        <td>{{ $registro->nome }}</td>
                        <td>{{ $registro->fone }}</td>
                        <td>{{ $registro->cidade }}</td>
                        <td>{{ $registro->saldo }}</td>
                        <td><a class="btn btn-success btn-sm" href="/saldovalor/{{ $registro->id }}/{{ $registro->saldo*100 }}/{{ $registro->nome }}" role="button">Autorizar</a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>    
        @endif 

    </div> 
    <!-- final -->
    @endsection