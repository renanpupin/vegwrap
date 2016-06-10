<h1>VegWrap</h1>
<br>
Um novo pedido foi realizado!
<hr/>
<br>
<b>Nome</b> {{$pedido->nome}}
<br>
<b>Telefone</b> {{$pedido->telefone}}
<br>
<b>Endereço</b> {{$pedido->endereco}}
<br>
<b>Bairro</b> {{$pedido->bairro}}
<br>
<b>Cep</b> {{$pedido->cep}}
<br>
<b>Observação</b> "{{$pedido->observacao}}"
<br>
<b>Pagamento</b> {{$pedido->metodo_pagamento}}
<br>
<b>Subtotal</b> R${{$pedido->subtotal}}
<br>
<b>Frete</b> R${{$pedido->frete}}
<br>
<b>Total</b> R${{$pedido->total}}
<br>
<p><b>Itens do Pedido</b></p>

@foreach($itens_pedido as $item)
    <p><b>Nome</b>: {{$item->Produto->nome}} | <b>Quantidade</b>: {{$item->quantidade}}</p>
@endforeach