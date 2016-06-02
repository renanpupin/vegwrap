@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Meus Pedidos</h1>

                @foreach($pedidos as $pedido)
                <div class="row">

                    <div class="col-xs-1">
                        <label>Id</label>
                        <p>{{$pedido->id}}</p>
                    </div>



                    <div class="col-xs-2">
                        <label>Data</label>
                        <p>{{$pedido->data}}</p>
                    </div>

                    <div class="col-xs-2">
                        <label>Pagamento</label>
                        <p>{{$pedido->metodo_pagamento == "" ? "Pendente" : ($pedido->metodo_pagamento == "pagamento_entrega" ? "Na entrega" : "Via Pagseguro")}}</p>
                    </div>

                    <div class="col-xs-2">
                        <label>Total</label>
                        <p>R$ {{$pedido->total}}</p>
                    </div>

                    <div class="col-xs-2">
                        <a href="/pedido/{{$pedido->id}}" style="margin-top: 25px; display: inline-block;">Ver detalhes</a>
                    </div>
                </div>
                    <hr>
                @endforeach

            </div>
        </div>
    </div>
@endsection
