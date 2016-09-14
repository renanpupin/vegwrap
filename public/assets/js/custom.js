$(document).ready(function(){

    //masks
    $("#telefone")
    .mask("(99) 9999-9999?9")
    .focusout(function (event) {  
        var target, phone, element;  
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
        phone = target.value.replace(/\D/g, '');
        element = $(target);  
        element.unmask();  
        if(phone.length > 10) {  
            element.mask("(99) 99999-999?9");  
        } else {  
            element.mask("(99) 9999-9999?9");  
        }  
    });

    $("#cep").mask("99999-999");

    //click
    $(".btnCalcularFrete").click(function(e){
        var valid = true;

        if($("#logradouro").val() === ""){
            valid = false;
        }

        if($("#numero").val() === ""){
            valid = false;
        }

        if($("#bairro").val() === ""){
            valid = false;
        }

        if($("#cep").val() === ""){
            valid = false;
        }

        if(!valid){
            alert("Preencha os campos para calcular o frete");
        }else{
            console.log("calculando o frete");
            var endereco_origem = "Avenida+Paulo+Marcondes,190+Presidente+Prudente+São+Paulo";
            var endereco_entrega = $("#logradouro").val()+","+$("#numero").val()+"+Presidente+Prudente+São+Paulo";
            endereco_entrega = endereco_entrega.replace(/ /g, '+');


            var service = new google.maps.DistanceMatrixService();

            service.getDistanceMatrix(
                {
                    origins: [endereco_origem],
                    destinations: [endereco_entrega],
                    travelMode: google.maps.TravelMode.DRIVING,
                    avoidHighways: false,
                    avoidTolls: false
                },
                callback
            );

            function callback(response, status) {
                if(status=="OK") {
                    var distance = response.rows[0].elements[0].distance.value;

                    if(distance > 10000){
                        alert("A distância máxima para a entrega é de 10km.");
                    }else{
                        if(distance < 5000){
                            $("#frete").val("2");
                        }else{
                            $("#frete").val("3");
                        }

                        $(".info-frete").html("Valor do frete: R$ "+$("#frete").val()+",00 ("+response.rows[0].elements[0].distance.text+")");

                        $(".btnFazerPedido").prop("disabled", false);
                    }

                } else {
                    alert("Não foi possível calcular o frete! Erro: " + status);
                }
            }

            //$.get( "https://maps.googleapis.com/maps/api/distancematrix/json?origins="+endereco_origem+"&destinations="+endereco_entrega+"&mode=driving", function( data ) {
            //    if(data.status == "OK"){
            //        var distance = data.rows[0].elements[0].distance.value;
            //
            //        if(distance > 10000){
            //            alert("A distância máxima para a entrega é de 10km.");
            //        }else{
            //            if(distance < 5000){
            //                $("#frete").val("2");
            //            }else{
            //                $("#frete").val("3");
            //            }
            //
            //            $(".info-frete").html("Valor do frete: R$ "+$("#frete").val()+",00");
            //
            //            $(".btnFazerPedido").prop("disabled", false);
            //        }
            //    }else{
            //        alert("Não foi possível calcular o frete para o endereço informado");
            //    }
            //    //alert(data.rows[0].elements[0].distance.text);
            //});
        }
    });

    $(".btnFazerPedido").click(function(e){
        var valid = true;

        if($("#frete").val() === ""){
            valid = false;
        }

        if($("#nome").val() === ""){
            valid = false;
        }

        if($("#telefone").val() === ""){
            valid = false;
        }

        if($("#logradouro").val() === ""){
            valid = false;
        }

        if($("#numero").val() === ""){
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
            }else if($("#nome").val() == "" || $("#logradouro").val() == "" || $("#numero").val() == "" || $("#bairro").val() == "" || $("#cep").val() == "" || $("#telefone").val() == ""){
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
                var logradouro = $("#logradouro").val();
                var numero = $("#numero").val();
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

                if(logradouro != "" && logradouro != undefined && logradouro != null){
                    $(".entrega-logradouro").text(logradouro);
                }else{
                    $(".entrega-logradouro").text("Não preenchido");
                }

                if(numero != "" && numero != undefined && numero != null){
                    $(".entrega-numero").text(numero);
                }else{
                    $(".entrega-numero").text("Não preenchido");
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
            }else if($(".entrega-nome").text() == "Não preenchido" || $(".entrega-logradouro").text() == "Não preenchido" || $(".entrega-numero").text() == "Não preenchido" || $(".entrega-telefone").text() == "Não preenchido" || $(".entrega-bairro").text() == "Não preenchido" || $(".entrega-cep").text() == "Não preenchido"){
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

//pesquisa de cep
function limpa_formulário_cep() {
    $("#logradouro").val("");
    $("#bairro").val("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        $("#logradouro").val(conteudo.logradouro);
        $("#bairro").val(conteudo.bairro);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}
    
function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#logradouro").val("...");
            $("#bairro").val("...");

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};