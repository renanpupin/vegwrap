$(".btnPedido").click(function(e){
    e.preventDefault();
    e.stopPropagation();
    $( "#modal" ).Modal({
        "title": "Cardápio",
        "size": "large",
        "onConfirm": enviarPedido,
        "closeButtonText": "CANCELAR",
        "confirmButtonText": "FINALIZAR PEDIDO"
    });
});

$( "#modal" ).Modal({
    "title": "Cardápio",
    "size": "large",
    "onConfirm": enviarPedido,
    "closeButtonText": "CANCELAR",
    "confirmButtonText": "FINALIZAR PEDIDO"
});

function enviarPedido(){
    alert('pedido enviado');
}