@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBN3guDKF2RuMckhiLDEusgV7G8qJ361ek"></script>
<form id="formPedido" class="form-horizontal" role="form" method="POST" action="{{ url('pedido') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="container">
        @if($hasPedidoPendente)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p style="padding: 60px;">Você tem um pedido pendente!<br>Para fazer um novo pedido você deverá selecionar o método de pagamento ou cancelar o pedido existente!</p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading" style="background-color: #E46666; color: #fff;">Cardápio</div>--}}
                        <h1>Cardápio</h1>

                        {{--<div class="panel-body">--}}

                            <ul class="nav nav-tabs" id="menu">
                                <li class="active"><a href="#" data-target="#wrap-itens-salgados" data-toggle="tab">Wraps Salgados</a></li>
                                <li><a href="#" data-target="#wrap-itens-doces" data-toggle="tab">Wraps Doces</a></li>
                                <li><a href="#" data-target="#sucos-itens" data-toggle="tab">Sucos (500 ml)</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="wrap-itens-salgados">
                                    <div class="table-responsive">
                                        <table class="table table-hover wrap-table wraps-salgados">
                                            <thead>
                                            <tr>
                                                <th style="width: 50px;"></th>
                                                {{--<th style="width: 125px;">Imagem</th>--}}
                                                <th>Descrição</th>
                                                <th style="width: 100px;">Preço</th>
                                                <th style="width: 75px;">Quantidade</th>
                                                <th style="width: 100px;">Adicionais</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($wraps_salgados as $wrap_salgado)
                                                    <tr>
                                                        <td style="vertical-align: middle;">
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
                                                            R$ <span>{{number_format($wrap_salgado->preco, 2, ',', '.')}}</span>
                                                        </td>
                                                        <td>
                                                            <input name="wrap-{{$wrap_salgado->id}}-qtd" class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="item-adicional" data-idwrap="{{$wrap_salgado->id}}">Alterar</a>
                                                            <div style="display: none;" class="wrap-{{$wrap_salgado->id}}-adicionais">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="wrap-itens-doces">
                                    <div class="table-responsive">
                                        <table class="table table-hover wrap-table wraps-doces">
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
                                                        <td style="vertical-align: middle;">
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
                                                            R$ <span>{{number_format($wrap_doce->preco, 2, ',', '.')}}</span>
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
                                        <table class="table table-hover wrap-table sucos">
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
                                                        <td style="vertical-align: middle;">
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
                                                            R$ <span>{{number_format($suco->preco, 2, ',', '.')}}</span>
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


                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            </div>

            {{--<div class="row">--}}
                <div class="col-md-10 col-md-offset-1">
                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading" style="background-color: #8cd1a8; color: #fff;">Informações de Entrega</div>--}}
                        <h1>Informações de Entrega</h1>

                        {{--<div class="panel-body">--}}
                            {{--<h3>Informações de Entrega</h3>--}}
                            <div class="info-entrega">
                                <label for="nome">Nome Completo *</label>
                                <input type="text" name="nome" id="nome">

                                <label for="telefone">Telefone *</label>
                                <input type="text" name="telefone" id="telefone">

                                <div class="inline-fields" style="padding-right: 5px;">
                                    <label for="logradouro">Logradouro *</label>
                                    <input type="text" name="logradouro" id="logradouro">
                                </div>

                                <div class="inline-fields">
                                    <label for="numero">Número *</label>
                                    <input type="text" name="numero" id="numero">
                                </div>

                                <div class="inline-fields" style="padding-right: 5px;">
                                    <label for="bairro">Bairro *</label>
                                    <input type="text" name="bairro" id="bairro">
                                </div>

                                <div class="inline-fields">
                                    <label for="cep">CEP *</label>
                                    <input type="text" name="cep" id="cep" onblur="pesquisacep(this.value);">
                                </div>

                                <label for="observacao">Observação</label>
                                <div>
                                	<input type="checkbox" class="mostrar_observacao"> Quero adicionar uma observação.
                            	</div>
                                <textarea name="observacao" id="observacao" style="display: none;"></textarea>

                                <br>

                                <input type="hidden" name="frete" id="frete">
                                <p class="info-frete"></p>

                                <p style="color: red;">* Só realizamos entrega dentro da cidade de Presidente Prudente (até 10km).</p>
                                <p style="color: red;">* Taxa de frete R$2,00 até 5km ou R$3,00 até 10km.</p>
                            </div>
                        {{--</div>--}}
                    </div>
                </div>
            {{--</div>--}}

            <div class="row">
                <div class="col-md-10 col-md-offset-1" style="text-align: center;">
                    <button class="btnCalcularFrete" type="button" style="margin-right: 10px;">Calcular Frete</button>
                    <button class="btnFazerPedido" disabled="true">Fazer Pedido</button>
                </div>
            </div>
        @endif
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="modalMensagem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style= "max-width: 375px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
            		<!-- <span style="font-weight: bold; padding-right: 40px;">:(</span> -->
                	VegWrap - Informação
            	</h4>
            </div>
            <div class="modal-body">
            	...
            </div>
            <div class="modal-footer">
            	<button id="buttonOkModalMensagem" class="btn buttonOkModal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdicionais" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Adicionais</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover adicionais-table">
                        <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Nome</th>
                            <th style="width: 100px;">Preço</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="alface">
                                </td>
                                <td class="adicional-nome">Alface</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr>
                            {{-- <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="azeite-de-oliva">
                                </td>
                                <td class="adicional-nome">Azeite de Oliva</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr> --}}
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="azeitona">
                                </td>
                                <td class="adicional-nome">Azeitona</td>
                                <td class="adicional-preco">R$ <span>0,75</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="brocolis">
                                </td>
                                <td class="adicional-nome">Brócolis</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="cebola-roxa">
                                </td>
                                <td class="adicional-nome">Cebola Roxa</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="cenoura">
                                </td>
                                <td class="adicional-nome">Cenoura</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="ervilha">
                                </td>
                                <td class="adicional-nome">Ervilha</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="espinafre">
                                </td>
                                <td class="adicional-nome">Espinafre</td>
                                <td class="adicional-preco">R$ <span>0,75</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="milho">
                                </td>
                                <td class="adicional-nome">Milho</td>
                                <td class="adicional-preco">R$ <span>0,50</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="mussarela">
                                </td>
                                <td class="adicional-nome">Mussarela</td>
                                <td class="adicional-preco">R$ <span>1,00</span></td>
                            </tr>
                            {{-- <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="repolho-roxo">
                                </td>
                                <td class="adicional-nome">Repolho Roxo</td>
                                <td class="adicional-preco">R$ <span>1,50</span></td>
                            </tr> --}}
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="requeijao">
                                </td>
                                <td class="adicional-nome">Requeijão</td>
                                <td class="adicional-preco">R$ <span>0,75</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="ricota">
                                </td>
                                <td class="adicional-nome">Ricota</td>
                                <td class="adicional-preco">R$ <span>1,25</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="rucula">
                                </td>
                                <td class="adicional-nome">Rúcula</td>
                                <td class="adicional-preco">R$ <span>0,75</span></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="checkbox" class="adicional-select" name="adicional-select[]" value="tomate-seco">
                                </td>
                                <td class="adicional-nome">Tomate Seco</td>
                                <td class="adicional-preco">R$ <span>1,50</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary btnSalvarAdicionalModal">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endsection
