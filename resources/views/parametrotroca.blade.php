@extends('layouts.layout-sistema')

@section('conteudo')

<!-- area para cadastro de nova linha na tabela -->
<hr>
<div class="row">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <h4>Adicionar parametriza&ccedil;&atilde;o</h4>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <form action="/parametrotroca" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cd_classificacao" class="form-label">Classifica&ccedil;&atilde;o | Par&acirc;metro</label>
                            <input type="text" class="form-control" id="cd_classificacao" name="cd_classificacao" aria-describedby="classificacaoHelp" required list="lsclassificacao">
                            <div id="classificacaoHelp" class="form-text">Informe a sigla da classifica&ccedil;&atilde;o do cliente</div>
                            <datalist id="lsclassificacao">
                                <option value="PERIODO_AVALIAÇÃO">Per&iacute;odo de avalia&ccedil;&atilde;o das compras (em dias)</option>
                                <option value="FATOR_SAÍDA">Fator convers&atilde;o R$ para Saldo na venda do produto</option>
                                <option value="FATOR_DEVOLUÇÃO">Fator convers&atilde;o R$ para Saldo na devolu&ccedil;&atilde;o do produto</option>
                                <option value="AT">Aten&ccedil;&atilde;o</option>
                                <option value="CA">Campe&atilde;o</option>
                                <option value="ER">Em Risco</option>
                                <option value="FI">Fiel</option>
                                <option value="HI">Hibernando</option>
                                <option value="NP">N&atilde;o Perder</option>
                                <option value="PE">Pedidos</option>
                                <option value="PF">Potencial Fiel</option>
                                <option value="PH">Pr&oacute;ximo Hibernar</option>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="fator" class="form-label">Fator em % | Par&acirc;metro</label>
                            <input type="number" class="form-control" id="fator" name="fator" aria-describedby="fatorHelp" step="0.1" required>
                            <div id="fatorhelp" class="form-text">Informe percentual a ser aplicado ao saldo ou par&acirc;metro de configura&ccedil;&atilde;o</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Gravar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

<!-- area de apresentar conteudo da tabela --> 
@if(count($parametrotrocas) > 0)
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Classifica&ccedil;&atilde;o</th>
            <th scope="col">Fator</th>
            <th></th>
            </tr>
        </thead> 
        <tbody>
            @foreach($parametrotrocas as $dados)
            <tr>
            <td>{{$dados->cd_classificacao}}</td>
            <td>{{$dados->fator}}</td> 
            <td><a class="btn" href="/parametrotrocaDel/{{$dados->id}}" role="button"><i class="bi bi-trash3"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection