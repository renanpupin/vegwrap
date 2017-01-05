@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Alterar Pedido {{$pedido->id}}</h1>

                <div class="row">
                    <form id="formAlterarPedido" class="form-horizontal" role="form" method="POST" action="{{ url('pedido/'.$pedido->id.'/salvar') }}">
                        <div class="col-md-8 col-xs-12">
                            <!-- <input name="_method" type="hidden" value="PUT"> -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <select id="status" name="status" class="form-control">
                                <option value="pendente" {{$pedido->status == "pendente" ? " selected='selected'" : ""}}>Pendente</option>
                                <option value="em_producao" {{$pedido->status == "em_producao" ? " selected='selected'" : ""}}>Em Produção</option>
                                <option value="em_entrega" {{$pedido->status == "em_entrega" ? " selected='selected'" : ""}}> Em Entrega</option>
                                <option value="finalizado" {{$pedido->status == "finalizado" ? " selected='selected'" : ""}}>Finalizado</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <button type="submit" id="alterarPedido" style="padding: 7px; margin-top: 0;" class="btnCheckout">Alterar Status</button>
                        </div>
                    </form>
                </div>

                <br>

                <div class="row">
                    <div class="col-xs-12 col-md-2">
                        <label>Subtotal</label>
                        <p>R$ {{$pedido->subtotal}}</p>
                    </div>

                    <div class="col-xs-12 col-md-2">
                        <label>Frete</label>
                        <p>R$ {{$pedido->frete}}</p>
                    </div>

                    <div class="col-xs-12 col-md-2">
                        <label>Total</label>
                        <p>R$ {{$pedido->total}}</p>
                    </div>

                    <div class="col-xs-12 col-md-2">
                        <label>Data</label>
                        <p>{{$pedido->data}}</p>
                    </div>

                    <div class="col-xs-12 col-md-2">
                        <label>Pagamento</label>
                        <p>{{$pedido->metodo_pagamento == "" ? "Pendente" : ($pedido->metodo_pagamento == "pagamento_entrega" ? "Na entrega" : "Via Pagseguro")}}</p>
                    </div>

                </div>

                <hr>

                <h3>Produtos</h3>

                @foreach($itens_pedido as $item_pedido)
                    <div class="row">
                        <div class="col-xs-8">
                            <label>Nome</label>
                            <p>{{($item_pedido->Produto->tipo == "wrap_salgado" || $item_pedido->Produto->tipo == "wrap_doce") ? "Wrap" : "Suco"}} {{$item_pedido->Produto->nome}}</p>
                        </div>

                        <div class="col-xs-4">
                            <label>Quantidade</label>
                            <p>{{$item_pedido->quantidade}}</p>
                        </div>
                        @if(count($item_pedido->adicionais) > 0)
                            <div class="col-xs-12">
                                <label>Adicionais</label>
                                @foreach($item_pedido->adicionais as $adicional)
                                    <p>{{$adicional->nome}}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <hr>
                @endforeach

                {{--<hr>--}}

                <h3>Informações da Entrega</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome</label>
                            <p>{{$pedido->nome}}</p>
                        </div>

                        <div class="col-md-4">
                            <label>Telefone</label>
                            <p>{{$pedido->telefone}}</p>
                        </div>

                        <div class="col-md-6">
                            <label>Endereço</label>
                            <p>{{$pedido->endereco}}</p>
                        </div>

                        <div class="col-md-3">
                            <label>Bairro</label>
                            <p>{{$pedido->bairro}}</p>
                        </div>

                        <div class="col-md-3">
                            <label>Cep</label>
                            <p>{{$pedido->cep}}</p>
                        </div>

                        @if($pedido->observacao != "")
                        <div class="col-md-12">
                            <label>Observação</label>
                            <p>{{$pedido->observacao}}</p>
                        </div>
                        @endif
                    </div>



            </div>
        </div>
    </div>
@endsection
