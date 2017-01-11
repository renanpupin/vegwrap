@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Lista de Pedidos</h1>

                <div class="table-responsive">
                <table class="table table-hover wrap-table wraps-salgados">
                    <thead>
                    <tr>
                        <th style="width: 50px;">Id</th>
                        <th style="width: 100px;">Data</th>
                        <th style="width: 100px;">Pagamento</th>
                        <th style="width: 75px;">Status do Pagamento</th>
                        <th style="width: 75px;">Total</th>
                        <th style="width: 75px;">Status do Pedido</th>
                        <th style="width: 100px;">Detalhes</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>
                                    {{$pedido->id}}
                                </td>
                                <td>
                                    {{$pedido->data}}
                                </td>
                                <td>
                                    @if($pedido->metodo_pagamento=="")
                                        <p style="color: red;">{{$pedido->metodo_pagamento == "" ? "Pendente" : ($pedido->metodo_pagamento == "pagamento_entrega" ? "Na entrega" : "Via Pagseguro")}}</p>
                                    @else
                                        <p>{{$pedido->metodo_pagamento == "" ? "Pendente" : ($pedido->metodo_pagamento == "pagamento_entrega" ? "Na entrega" : "Via Pagseguro")}}</p>
                                    @endif
                                </td>
                                <td>
                                    {{$pedido->status_pagamento}}
                                </td>
                                <td>
                                    R$ {{$pedido->total}}
                                </td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="/pedido/{{$pedido->id}}">Ver detalhes</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
@endsection
