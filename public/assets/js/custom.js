$(".btnPedido").click(function(e){
    e.preventDefault();
    e.stopPropagation();
    $( "#modal" ).Modal({
        "title": "Cardápio",
        "size": "large",
        "onConfirm": enviarPedido,
        "closeButtonText": "VOLTAR",
        "confirmButtonText": "FINALIZAR PEDIDO"
    });
});

//$( "#modal" ).Modal({
//    "title": "Cardápio",
//    "size": "large",
//    "onConfirm": enviarPedido,
//    "closeButtonText": "VOLTAR",
//    "confirmButtonText": "FINALIZAR PEDIDO"
//});

function enviarPedido(){
    if($(".page1").hasClass("active")){

        var valid = true;
        //validações
        if($(".wrap-table").find("selected-item").size() > 0){
            valid = false;
        }else if($("#nome").val() == "" || $("#endereco").val() == "" || $("#bairro").val() == "" || $("#cep").val() == "" || $("#telefone").val() == ""){
            valid = false;
        }

        if(valid){
            $(".page1").fadeOut(500).removeClass("active");
            $(".page2").delay(500).fadeIn(500).addClass("active");

            $(".table-pedido").find("tbody tr").remove();
            if($(".selected-item").size() == 0){
                $(".table-pedido").find("tbody").append('<tr class="placefield-row"><td colspan="3">Sem itens selecionados para o pedido.</td></tr>');
            }else{
                var total = 0;
                $(".selected-item").each(function(index, element){
                    var nome = $(this).find(".wrap-name-description").find("p.item-name").text();
                    var preco = $(this).find(".item-preco").find("span").text();
                    var quantidade = $(this).find(".itemQtd").val();
                    $(".table-pedido").find("tbody").append('<tr><td>'+nome+'</td><td>R$ '+preco+'</td><td>'+quantidade+'</td></tr>');

                    total += parseFloat(String(preco).replace(",","."))*parseInt(quantidade);
                });
                $(".pedido-total").text(String(total.toFixed(2)).replace(".",","));
            }

            var nome = $("#nome").val();
            var endereco = $("#endereco").val();
            var telefone = $("#telefone").val();
            var bairro = $("#bairro").val();
            var cep = $("#cep").val();
            var observacao = $("#observacao").val();

            if(nome != "" && nome != undefined && nome != null){
                $(".entrega-nome").text(nome);
            }else{
                $(".entrega-nome").text("Não preenchido");
            }

            if(telefone != "" && telefone != undefined && telefone != null){
                $(".entrega-telefone").text(telefone);
            }else{
                $(".entrega-telefone").text("Não preenchido");
            }

            if(bairro != "" && bairro != undefined && bairro != null){
                $(".entrega-bairro").text(bairro);
            }else{
                $(".entrega-bairro").text("Não preenchido");
            }

            if(cep != "" && cep != undefined && cep != null){
                $(".entrega-cep").text(cep);
            }else{
                $(".entrega-cep").text("Não preenchido");
            }

            if(endereco != "" && endereco != undefined && endereco != null){
                $(".entrega-endereco").text(endereco);
            }else{
                $(".entrega-endereco").text("Não preenchido");
            }

            if(observacao != "" && observacao != undefined && observacao != null){
                $(".entrega-observacao").text(observacao);
            }else{
                $(".entrega-observacao").text("Não preenchido");
            }
        }else{
            alert("Por favor escolha os produtos e preencha as informações de entrega.");
        }
    }else{
        var valid = true;
        //validações
        if($(".table-pedido").find("placefield-row").size() > 0){
            alert("Por favor escolha seus produtos antes de finalizar o pedido.");
            valid = false;
        }else if($(".entrega-nome").text() == "Não preenchido" || $(".entrega-endereco").text() == "Não preenchido" || $(".entrega-telefone").text() == "Não preenchido" || $(".entrega-bairro").text() == "Não preenchido" || $(".entrega-cep").text() == "Não preenchido"){
            alert("Por favor preencha as informações de entrega.");
            valid = false;
        }

        if(valid){
            alert('pedido enviado');
            $(".page1").fadeIn(500).addClass("active");
            $(".page2").fadeOut(500).removeClass("active");

            $("#modal").removeClass("open");
            $("body").removeClass("openModal");
        }
    }
}

$("body").on("click", "#btnVoltarModal", function(){
    $(".page2").fadeOut(500).removeClass("active");
    $(".page1").fadeIn(500).addClass("active");
});

$(".wrap-select").click(function(){
   $(this).parents().eq(1).toggleClass("selected-item");
});