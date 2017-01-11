@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Pedido {{$pedido->id}}</h1>

                @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif

                @if( Auth::user()->type == "admin" && Auth::user()->id == $pedido->id_user)

                    <div class="row">
                        @if($pedido->metodo_pagamento == "")
                            <div class="col-md-3 col-xs-12">
                                <a id="cancelarPedido" class="btnCancelar" href="/cancelarPedido/{{$pedido->id}}">Cancelar Pedido</a>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <a id="pagarPagSeguro" class="btnCheckout" href="/pagarPagseguro/{{$pedido->id}}">Pagar com Pagseguro</a>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <a id="pagarEntrega" class="btnCheckout" href="/pagarEntrega/{{$pedido->id}}">Pagar na entrega (dinheiro)</a>
                            </div>
                        @endif

                        <div class="col-md-3 col-xs-12">
                            <a id="alterarPedido" class="btnUpdateStatus" href="/pedido/{{$pedido->id}}/alterar">Alterar Status</a>
                        </div>
                    </div>

                @endif

                @if( Auth::user()->type == "admin" && Auth::user()->id != $pedido->id_user)

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <a id="alterarPedido" class="btnUpdateStatus" href="/pedido/{{$pedido->id}}/alterar">Alterar Status</a>
                        </div>
                    </div>

                @endif

                @if( Auth::user()->type == "user")

                    @if($pedido->metodo_pagamento == "")
                        <p>Para finalizar seu pedido selecione o método de pagamento.</p>

                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <a id="cancelarPedido" class="btnCancelar" href="/cancelarPedido/{{$pedido->id}}">Cancelar Pedido</a>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <a id="pagarPagSeguro" class="btnCheckout" href="/pagarPagseguro/{{$pedido->id}}">Pagar com Pagseguro</a>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <a id="pagarEntrega" class="btnCheckout" href="/pagarEntrega/{{$pedido->id}}">Pagar na entrega (dinheiro)</a>
                            </div>
                        </div>

                    @endif

                @endif

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

                    @if( Auth::user()->type == "admin")
                    <div class="col-xs-12 col-md-2">
                        <label>Status do Pedido</label>
                        <p>
                            @if($pedido->status == "pendente")
                                <span style="color: #e04d1f;">Pendente</span>
                            @elseif($pedido->status == "em_producao")
                                <span style="color: #2dc3d4;">Em Produção</span>
                            @elseif($pedido->status == "em_entrega")
                                <span style="color: #d4832d;">Em Entrega</span>
                            @elseif($pedido->status == "finalizado")
                                <span style="color: #42ab20;">Finalizado</span>
                            @else
                                <span style="color: #42ab20;">{{$pedido->status}}</span>
                            @endif
                        </p>
                    </div>
                    @endif

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
