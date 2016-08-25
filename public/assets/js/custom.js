$(document).ready(function(){
    $(".btnFazerPedido").click(function(e){
        var valid = true;

        if($("#nome").val() === ""){
            valid = false;
        }

        if($("#telefone").val() === ""){
            valid = false;
        }

        if($("#endereco").val() === ""){
            valid = false;
        }

        if($("#bairro").val() === ""){
            valid = false;
        }

        if($("#cep").val() === ""){
            valid = false;
        }

        if(!$(".wrap-select:checked").size() > 0){
            valid = false;
        }

        if(!valid){
            e.preventDefault();
            e.stopPropagation();
            alert("Preencha todas as informações para completar o pedido!");
        }

    });


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
                    var frete = 2;
                    $(".selected-item").each(function(index, element){
                        var nome = $(this).find(".wrap-name-description").find("p.item-name").text();
                        var preco = $(this).find(".item-preco").find("span").text();
                        var quantidade = $(this).find(".itemQtd").val();
                        $(".table-pedido").find("tbody").append('<tr><td>'+nome+'</td><td>R$ '+preco+'</td><td>'+quantidade+'</td></tr>');

                        total += parseFloat(String(preco).replace(",","."))*parseInt(quantidade);
                    });
                    $(".pedido-subtotal").text(String(total.toFixed(2)).replace(".",","));
                    $(".pedido-frete").text(String(frete.toFixed(2)).replace(".",","));
                    total = total + frete;
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

    $(".wrap-select").click(function(){
       $(this).parents().eq(1).toggleClass("selected-item");
    });

    $(".item-adicional").click(function(){
        var id = $(this).attr("data-idwrap");
        //console.log(id);
        $('#modalAdicionais').attr("current-id", id);

        $(".adicional-select").prop('checked', false);

        $(".wrap-"+id+"-adicionais").find('.adicional-'+id+'-code').each(function(index, elem){
            var code = $(elem).val();
            $(":checkbox[value="+code+"]").prop("checked","true");
        });

        $('#modalAdicionais').modal();
    });

    $(".btnSalvarAdicionalModal").click(function(){
        var id = $('#modalAdicionais').attr("current-id");
        //console.log(id);
        $(".wrap-"+id+"-adicionais").empty();

        $('#modalAdicionais').find(".adicionais-table tbody tr").each(function(index, elem){
            //console.log($(elem).find(".adicional-select").is(":checked"));
            if($(elem).find(".adicional-select").is(":checked")){
                var code = $(elem).find(".adicional-select").val();
                var nome = $(elem).find(".adicional-nome").html();
                var preco = $(elem).find(".adicional-preco span").html();
                preco = preco.replace(",", ".");
                $(".wrap-"+id+"-adicionais").append('<input type="hidden" name="adicional-'+id+'-nome[]" value="'+nome+'">');
                $(".wrap-"+id+"-adicionais").append('<input type="hidden" name="adicional-'+id+'-preco[]" value="'+preco+'">');
                $(".wrap-"+id+"-adicionais").append('<input type="hidden" class="adicional-'+id+'-code" value="'+code+'">');
            }
            //console.log(elem);
        });

        $('#modalAdicionais').modal('hide')
    });
});