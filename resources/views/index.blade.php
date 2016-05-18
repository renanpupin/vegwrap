<!DOCTYPE HTML>
<html>
<head>
    <title>Veg Wrap</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="{!! asset('assets/js/ie/html5shiv.js') !!}"></script><![endif]-->
    <link rel="stylesheet" href="{!! asset('assets/css/main.css') !!}" />
    <link rel="stylesheet" href="{!! asset('assets/css/custom.css') !!}" />
    <!--[if lte IE 8]><link rel="stylesheet" href="{!! asset('assets/css/ie8.css') !!}" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="{!! asset('assets/css/ie9.css') !!}" /><![endif]-->

    <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="overlay"></div>

<!-- Header -->
<section id="header">
    <header class="major">
        <!-- Wrap icon by Icons8 -->
        <img class="logo-icon" src="data:image/png;base64,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" width="75" height="75">
        <h1>Veg Wrap</h1>
        <p>Porque ser <strong>{ vegetariano & Saudável }</strong> é mais legal</p>
    </header>
    <div class="container">
        <ul class="actions">
            <li><a href="#one" class="button special scrolly btnConhecer">Conhecer</a></li>
            <li><a href="#" class="button special scrolly btnPedido">Fazer Pedido</a></li>
        </ul>
    </div>

</section>

<!-- One -->
<section id="one" class="main special">
    <div class="container">
        <span class="image fit primary"><img src="assets/images/8.jpg" alt="" /></span>
        <div class="content">
            <header class="major">
                <h2>Quem somos?</h2>
            </header>
            <p>Somos uma empresa que busca levar ao cliente uma experiência diferente, onde ele saiba que se está comendo algo delicioso, e ao mesmo tempo trazer empatia, com um estilo de vida saudável e harmônico com o meio ambiente e contra o sofrimento dos animais.</p>
        </div>
        <a href="#two" class="goto-next scrolly">Next</a>
    </div>
</section>

<!-- Two -->
<section id="two" class="main special">
    <div class="container">
        <span class="image fit primary"><img src="assets/images/9.jpg" alt="" /></span>
        <div class="content">
            <header class="major">
                <h2>Coisas que oferecemos</h2>
            </header>
            <p>Abaixo estão algumas das coisas que desejamos passar aos nossos clientes</p>
            <ul class="icons-grid">
                <li>
                    <span class="icon major fa-check-square-o"></span>
                    <h3>Alimento delicioso</h3>
                </li>
                <li>
                    <span class="icon major fa-usd"></span>
                    <h3>Preço baixo</h3>
                </li>
                <li>
                    <span class="icon major fa-paw"></span>
                    <h3>Conscientização Animal</h3>
                </li>
                <li>
                    <span class="icon major fa-heartbeat"></span>
                    <h3>Estilo de vida <br>saudável</h3>
                </li>
            </ul>
        </div>
        <a href="#three" class="goto-next scrolly">Next</a>
    </div>
</section>

<!-- Three -->
<section id="three" class="main special">
    <div class="container">
        <span class="image fit primary"><img src="assets/images/13.jpg" alt="" /></span>
        <div class="content">
            <header class="major">
                <h2>Mais uma coisa</h2>
            </header>
            <p>Vegetarianismo não é apenas deixar de comer carne – seja ela vermelha, de ave, de peixe ou produtos derivados – mas adotar hábitos alimentares mais saudáveis e nutritivos. A dieta é baseada no consumo de cereais integrais, hortaliças, frutas, leguminosas, grãos e sementes -
                sem contar com as motivações ligadas aos direitos dos animais e às preocupações ambientais.</p>
        </div>
        <a href="#footer" class="goto-next scrolly">Next</a>
    </div>
</section>

<!-- Footer -->
<section id="footer">
    <div class="container">
        <header class="major">
            <h2>Você ainda tem dúvida? <br> Agora você está pronto :)</h2>
        </header>
        <ul class="actions">
            <li><input type="button" value="Fazer Pedido" class="special btnPedido" /></li>
        </ul>
    </div>
    <footer>
        <ul class="icons">
            <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
        </ul>
        <ul class="copyright">
            <li>&copy; VegWrap 2016</li><li>Todos os direitos reservados</li>
        </ul>
    </footer>
</section>

<div id="modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id=""></h4>
            </div>

            <div class="modal-body page1 active">
                <p style="color: red;">* Só realizamos entrega dentro da cidade de Presidente Prudente.</p>
                <h5>Wraps Salgados</h5>
                <div class="table-responsive">
                    <table class="wrap-table wraps-salgados">
                        <thead>
                            <tr>
                                <th style="width: 50px;"></th>
                                <th style="width: 125px;">Imagem</th>
                                <th>Descrição</th>
                                <th style="width: 100px;">Preço</th>
                                <th style="width: 75px;">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="wrap-select">
                                </td>
                                <td>
                                    <img class="wrap-item-image" src="assets/images/wrap_salgado.jpg">
                                </td>
                                <td class="wrap-name-description">
                                    <p class="item-name">Wrap de Frango</p>
                                    <p class="small-font">Frango, alface, tomate</p>
                                </td>
                                <td class="item-preco">
                                    R$ <span>8,50</span>
                                </td>
                                <td>
                                    <input class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="wrap-select">
                                </td>
                                <td>
                                    <img class="wrap-item-image" src="assets/images/wrap_salgado.jpg">
                                </td>
                                <td class="wrap-name-description">
                                    <p class="item-name">Wrap de Peito de Peru</p>
                                    <p class="small-font">Peito de Peru, alface, tomate</p>
                                </td>
                                <td class="item-preco">
                                    R$ <span>9,50</span>
                                </td>
                                <td>
                                    <input class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h5>Wraps Doces</h5>
                <div class="table-responsive">
                    <table class="wrap-table wraps-salgados">
                        <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th style="width: 125px;">Imagem</th>
                            <th>Descrição</th>
                            <th style="width: 100px;">Preço</th>
                            <th style="width: 75px;">Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="wrap-select">
                            </td>
                            <td>
                                <img class="wrap-item-image" src="assets/images/wrap_doce.jpg">
                            </td>
                            <td class="wrap-name-description">
                                <p class="item-name">Wrap de Morango</p>
                                <p class="small-font">Morango</p>
                            </td>
                            <td class="item-preco">
                                R$ <span>10,50</span>
                            </td>
                            <td>
                                <input class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="wrap-select">
                            </td>
                            <td>
                                <img class="wrap-item-image" src="assets/images/wrap_doce.jpg">
                            </td>
                            <td class="wrap-name-description">
                                <p class="item-name">Wrap de Nutella</p>
                                <p class="small-font">Nutella</p>
                            </td>
                            <td class="item-preco">
                                R$ <span>10,50</span>
                            </td>
                            <td>
                                <input class="itemQtd"  type="number" min="1" max="20" value="1" style="text-align: center;">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h5>Sucos</h5>
                <div class="table-responsive">
                    <table class="wrap-table wraps-salgados">
                        <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th style="width: 125px;">Imagem</th>
                            <th>Descrição</th>
                            <th style="width: 100px;">Preço</th>
                            <th style="width: 75px;">Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="wrap-select">
                            </td>
                            <td>
                                <img class="wrap-item-image" src="assets/images/suco.png">
                            </td>
                            <td class="wrap-name-description">
                                <p class="item-name">Suco de Limão</p>
                                <p class="small-font">Limão, açúcar</p>
                            </td>
                            <td class="item-preco">
                                R$ <span>6,00</span>
                            </td>
                            <td>
                                <input class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="wrap-select">
                            </td>
                            <td>
                                <img class="wrap-item-image" src="assets/images/suco.png">
                            </td>
                            <td class="wrap-name-description">
                                <p class="item-name">Suco de Laranja</p>
                                <p class="small-font">Laranja, açúcar</p>
                            </td>
                            <td class="item-preco">
                                R$ <span>6,00</span>
                            </td>
                            <td>
                                <input class="itemQtd" type="number" min="1" max="20" value="1" style="text-align: center;">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h5>Informações de Entrega</h5>
                <div class="info-entrega">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome">

                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" id="telefone">

                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco">

                    <div class="inline-fields" style="padding-right: 5px;">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro">
                    </div>

                    <div class="inline-fields">
                        <label for="cep">CEP</label>
                        <input type="text" name="cep" id="cep">
                    </div>

                    <label for="observacao">Observação</label>
                    <textarea name="observacao" id="observacao"></textarea>
                </div>
            </div>

            <div class="modal-body page2">
                <h5>Informações do pedido</h5>
                <div class="table-responsive">
                    <table class="wrap-table table-pedido">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th style="width: 100px;">Preço</th>
                            <th style="width: 75px;">Quantidade</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <h5>Total: R$ <span class="pedido-total"></span></h5>
                </div>

                <hr>

                <h5>Informações de Entrega</h5>
                <div class="info-entrega">
                    <label for="nome">Nome</label>
                    <p class="entrega-nome"></p>

                    <label for="telefone">Telefone</label>
                    <p class="entrega-telefone"></p>

                    <label for="endereco">Endereço</label>
                    <p class="entrega-endereco"></p>

                    <label for="bairro">Bairro</label>
                    <p class="entrega-bairro"></p>

                    <label for="cep">CEP</label>
                    <p class="entrega-cep"></p>

                    <label for="observacao">Observação</label>
                    <p class="entrega-observacao"></p>
                </div>
            </div>

            <div class="modal-footer"></div>

        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.scrollex.min.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.scrolly.min.js') !!}"></script>
<script src="{!! asset('assets/js/skel.min.js') !!}"></script>
<script src="{!! asset('assets/js/util.js') !!}"></script>
<!--[if lte IE 8]><script src="{!! asset('assets/js/ie/respond.min.js') !!}"></script><![endif]-->
<script src="{!! asset('assets/js/main.js') !!}"></script>
<script src="{!! asset('assets/js/modal.js') !!}"></script>
<script src="{!! asset('assets/js/custom.js') !!}"></script>

</body>
</html>