@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Meus Pedidos</h1>

                <div class="table-responsive">
                <table class="table table-hover wrap-table wraps-salgados">
                    <thead>
                    <tr>
                        <th style="width: 50px;">Id</th>
                        <th style="width: 100px;">Data</th>
                        <th style="width: 100px;">Pagamento</th>
                        <th style="width: 75px;">Total</th>
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
                                    R$ {{$pedido->total}}
                                </td>
                                <td>
                                    <a href="/pedido/{{$pedido->id}}">Ver detalhes</a>
                                </td>
                            </tr>
                        @endforeach

                        @if (count($pedidos) == 0)
                            <tr>
                                <td colspan="5">
                                    Nenhum pedido realizado, faça agora seu primeiro pedido clicando 
                                    <a href="/home">aqui</a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
@endsection
