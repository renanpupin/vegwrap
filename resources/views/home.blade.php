@extends('layouts.app')

@section('content')
<form id="formPedido" class="form-horizontal" role="form" method="POST" action="{{ url('pedido') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #E46666; color: #fff;">Cardápio</div>

                    <div class="panel-body">

                        <ul class="nav nav-tabs" id="menu">
                            <li class="active"><a href="#" data-target="#wrap-itens-salgados" data-toggle="tab">Wraps Salgados</a></li>
                            <li><a href="#" data-target="#wrap-itens-doces" data-toggle="tab">Wraps Doces</a></li>
                            <li><a href="#" data-target="#sucos-itens" data-toggle="tab">Sucos (500 ml)</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="wrap-itens-salgados">
                                <div class="table-responsive">
                                    <table class="wrap-table wraps-salgados">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px;"></th>
                                            {{--<th style="width: 125px;">Imagem</th>--}}
                                            <th>Descrição</th>
                                            <th style="width: 100px;">Preço</th>
                                            <th style="width: 75px;">Quantidade</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wraps_salgados as $wrap_salgado)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="wrap-select" name="wrap-select[]" value="{{$wrap_salgado->id}}">
                                                    </td>
                                                    {{--<td>--}}
                                                    {{--<img class="wrap-item-image" src="assets/images/wrap_salgado.jpg">--}}
                                                    {{--</td>--}}
                                                    <td class="wrap-name-description">
                                                        <p class="item-name">{{$wrap_salgado->nome}}</p>
                                                        <p class="small-font">{{$wrap_salgado->descricao}}</p>
                                                    </td>
                                                    <td class="item-preco">
                                                        R$ <span>{{$wrap_salgado->preco}}</span>
                                                    </td>
                                                    <td>
                                                        <input name="wrap-{{$wrap_salgado->id}}-qtd" class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="wrap-itens-doces">
                                <div class="table-responsive">
                                    <table class="wrap-table wraps-doces">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px;"></th>
                                            {{--<th style="width: 125px;">Imagem</th>--}}
                                            <th>Descrição</th>
                                            <th style="width: 100px;">Preço</th>
                                            <th style="width: 75px;">Quantidade</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wraps_doces as $wrap_doce)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="wrap-select" name="wrap-select[]" value="{{$wrap_doce->id}}">
                                                    </td>
                                                    {{--<td>--}}
                                                    {{--<img class="wrap-item-image" src="assets/images/wrap_salgado.jpg">--}}
                                                    {{--</td>--}}
                                                    <td class="wrap-name-description">
                                                        <p class="item-name">{{$wrap_doce->nome}}</p>
                                                        <p class="small-font">{{$wrap_doce->descricao}}</p>
                                                    </td>
                                                    <td class="item-preco">
                                                        R$ <span>{{$wrap_doce->preco}}</span>
                                                    </td>
                                                    <td>
                                                        <input name="wrap-{{$wrap_doce->id}}-qtd" class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="sucos-itens">
                                <div class="table-responsive">
                                    <table class="wrap-table sucos">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px;"></th>
                                            {{--<th style="width: 125px;">Imagem</th>--}}
                                            <th>Descrição</th>
                                            <th style="width: 100px;">Preço</th>
                                            <th style="width: 75px;">Quantidade</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sucos as $suco)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="wrap-select" name="suco-select[]" value="{{$suco->id}}">
                                                    </td>
                                                    {{--<td>--}}
                                                    {{--<img class="wrap-item-image" src="assets/images/wrap_salgado.jpg">--}}
                                                    {{--</td>--}}
                                                    <td class="wrap-name-description">
                                                        <p class="item-name">{{$suco->nome}}</p>
                                                        <p class="small-font">{{$suco->descricao}}</p>
                                                    </td>
                                                    <td class="item-preco">
                                                        R$ <span>{{$suco->preco}}</span>
                                                    </td>
                                                    <td>
                                                        <input name="suco-{{$suco->id}}-qtd" class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #8cd1a8; color: #fff;">Informações de Entrega</div>

                    <div class="panel-body">
                        {{--<h3>Informações de Entrega</h3>--}}
                        <div class="info-entrega">
                            <label for="nome">Nome *</label>
                            <input type="text" name="nome" id="nome">

                            <label for="telefone">Telefone *</label>
                            <input type="text" name="telefone" id="telefone">

                            <label for="endereco">Endereço *</label>
                            <input type="text" name="endereco" id="endereco">

                            <div class="inline-fields" style="padding-right: 5px;">
                                <label for="bairro">Bairro *</label>
                                <input type="text" name="bairro" id="bairro">
                            </div>

                            <div class="inline-fields">
                                <label for="cep">CEP *</label>
                                <input type="text" name="cep" id="cep">
                            </div>

                            <label for="observacao">Observação</label>
                            <textarea name="observacao" id="observacao"></textarea>

                            <p style="color: red;">* Só realizamos entrega dentro da cidade de Presidente Prudente (até 10km).</p>
                            <p style="color: red;">* Taxa de frete R$2,00 até 5km ou R$3,00 até 10km.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="text-align: center;">
                <button class="btnFazerPedido">Fazer Pedido</button>
            </div>
        </div>
    </div>
</form>
@endsection
