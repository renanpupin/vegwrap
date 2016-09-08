<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Produto;
use App\Pedido;
use App\ItensPedido;
use App\AdicionaisItemPedido;
use Auth;
//use laravel\pagseguro\Facades\PagSeguro;
use laravel\pagseguro\Platform\Laravel5\PagSeguro;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wraps_salgados = Produto::where('tipo', 'wrap_salgado')->get();
        $wraps_doces = Produto::where('tipo', 'wrap_doce')->get();
        $sucos = Produto::where('tipo', 'suco')->get();


        $pedidos = Pedido::where('id_user', Auth::user()->id)->get();

        $hasPedidoPendente = false;
        foreach($pedidos as $pedido){
            if($pedido->metodo_pagamento == ""){
                $hasPedidoPendente = true;
            }
        }

        return view('home')->with('hasPedidoPendente',$hasPedidoPendente)->with('wraps_salgados',$wraps_salgados)->with('wraps_doces',$wraps_doces)->with('sucos',$sucos);
    }

    public function pedido(Request $request)
    {
        $subtotal = 0;
        $frete = $request->get("frete");
//        dd($frete);

//        dd($request->all());
//        dd($request->get("wrap-select"));

        $selected_wraps = $request->get("wrap-select");
        if($selected_wraps != null) {
            foreach ($selected_wraps as $wrap) {
                $preco = Produto::find($wrap)->preco;
                $subtotal += ($preco * $request->get("wrap-" . $wrap . "-qtd"));

                $adicionais_wrap_preco = $request->get("adicional-".$wrap."-preco");
                for($i = 0; $i < sizeof($adicionais_wrap_preco); $i++){
                    $subtotal += ($adicionais_wrap_preco[$i] * $request->get("wrap-" . $wrap . "-qtd"));
                }

            }
        }


        $selected_sucos = $request->get("suco-select");
        if($selected_sucos != null){
            foreach($selected_sucos as $suco){
                $preco = Produto::find($suco)->preco;
                $subtotal += ($preco * $request->get("suco-".$suco."-qtd"));
            }
        }


        $pedido = Pedido::Create([
            'id_user' => Auth::user()->id,
            'subtotal' => $subtotal,
            'frete' => $frete,
            'total' => $subtotal + $frete,
            'nome' => $request->get("nome"),
            'telefone' => $request->get("telefone"),
            'endereco' => $request->get("logradouro").", ".$request->get("numero"),
            'bairro' => $request->get("bairro"),
            'cep' => $request->get("cep"),
            'observacao' => $request->get("observacao"),
            'metodo_pagamento' => "",
            'codigo_pagseguro' => "",
//            'status' => "pendente"
        ]);


        $selected_wraps = $request->get("wrap-select");
        if($selected_wraps != null) {
            foreach ($selected_wraps as $wrap) {
                $item_pedido = ItensPedido::Create([
                    'id_pedido' => $pedido->id,
                    'id_produto' => $wrap,
                    'quantidade' => $request->get("wrap-" . $wrap . "-qtd")
                ]);

                $adicionais_wrap_nome = $request->get("adicional-".$wrap."-nome");
                $adicionais_wrap_preco = $request->get("adicional-".$wrap."-preco");
                for($i = 0; $i < sizeof($adicionais_wrap_nome); $i++){
//                    dd($adicionais_wrap_nome[$i], $adicionais_wrap_preco[$i]);
                    AdicionaisItemPedido::Create([
                        'nome' => $adicionais_wrap_nome[$i],
                        'preco' => $adicionais_wrap_preco[$i],
                        'id_item_pedido' => $item_pedido->id
                    ]);
                }
            }
        }


        $selected_sucos = $request->get("suco-select");
        if($selected_sucos != null) {
            foreach ($selected_sucos as $suco) {
                ItensPedido::Create([
                    'id_pedido' => $pedido->id,
                    'id_produto' => $suco,
                    'quantidade' => $request->get("suco-" . $suco . "-qtd")
                ]);
            }
        }


        return redirect('/pedido/'.$pedido->id);
    }

    function detalhesPedido($id){

        $pedido = Pedido::where('id', $id)->first();

        if(!empty($pedido)) {

            $pedido->subtotal = number_format($pedido->subtotal, 2, ',', ' ');
            $pedido->frete = number_format($pedido->frete, 2, ',', ' ');
            $pedido->total = number_format($pedido->total, 2, ',', ' ');

            $pedido->data = $pedido->created_at->format('d/m/Y');

            $itens_pedido = ItensPedido::where('id_pedido', $pedido->id)->get();

            foreach($itens_pedido as $item){
                $item->adicionais = AdicionaisItemPedido::where('id_item_pedido', $item->id)->get();
            }

            return view('pedido')->with('pedido', $pedido)->with('itens_pedido', $itens_pedido);
        }else{
            return redirect('/home');
        }
    }

    function cancelarPedido($id){

        $pedido = Pedido::find($id);

        if(!empty($pedido)){
            $itens_pedido = ItensPedido::where('id_pedido', $pedido->id)->get();
            foreach($itens_pedido as $item){

                //removendo adicionais do item do pedido
                $adicionais_item_pedido = AdicionaisItemPedido::where('id_item_pedido', $item->id)->get();
                foreach($adicionais_item_pedido as $adicional){
                    $adicional->delete();
                }

                //removendo item do pedido
                $item->delete();
            }
            //removendo pedido
            $pedido->delete();
        }

        return redirect('/home');

    }

    function pedidos(){

        $pedidos = Pedido::where('id_user', Auth::user()->id)->get();

        foreach($pedidos as $pedido){
            $pedido->subtotal = number_format($pedido->subtotal, 2, ',', ' ');
            $pedido->frete = number_format($pedido->frete, 2, ',', ' ');
            $pedido->total = number_format($pedido->total, 2, ',', ' ');
            $pedido->data = $pedido->created_at->format('d/m/Y');
        }

        return view('pedidos')->with('pedidos', $pedidos);
    }

    function pagarEntrega($id){

        $pedido = Pedido::find($id);

        if(!empty($pedido)){
            $pedido->metodo_pagamento = "pagamento_entrega";
        }
        $pedido->save();

        $email = Auth::user()->email;

        $itens_pedido = ItensPedido::where('id_pedido', $pedido->id)->get();

        //email pra quem comprou
        Mail::send('emails.pedido', ['pedido' => $pedido, 'itens_pedido' => $itens_pedido], function($message) use ($email)
        {
            $message->subject('Confirmação de Pedido na Vegwrap');
            $message->from('pedido@vegwrap.com.br', 'Vegwrap');
            $message->to($email);
        });

        //email admin
        Mail::send('emails.confirmacaoPedido', ['pedido' => $pedido, 'itens_pedido' => $itens_pedido], function($message)
        {
            $message->subject('Novo Pedido na Vegwrap');
            $message->from('pedido@vegwrap.com.br', 'Vegwrap');
            $message->to('pedido@vegwrap.com.br', 'Vegwrap');
            $message->cc('renan.pupin@gmail.com');
        });

        return view('notificacao_pagamento');
    }

    function pagarPagseguro($id){

        $pedido = Pedido::find($id);

        if(!empty($pedido)){
            $pedido->metodo_pagamento = "pagamento_pagseguro";
        }
//        $pedido->save();

        $data = [
            'items' => [],
            'sender' => [
                'email' => $pedido->email,
                'name' => $pedido->nome,
                'phone' => $pedido->telefone,
            ]
        ];

        $itens_pedido = ItensPedido::where('id_pedido', $pedido->id)->get();
        foreach($itens_pedido as $item){
            $data['items'][] = [
                'id' => $item->Produto->id,
                'description' => ($item->Produto->tipo == "suco" ? "Suco de ".$item->Produto->nome : "Wrap ".$item->Produto->nome),
                'quantity' => $item->quantidade,
                'amount' => $item->Produto->preco,
                'weight' => '0',
                'shippingCost' => '0',
                'width' => '0',
                'height' => '0',
                'length' => '0',
            ];

            $adicionais_item_pedido = AdicionaisItemPedido::where('id_item_pedido', $item->id)->get();

            foreach($adicionais_item_pedido as $adicional){
                $data['items'][] = [
                    'id' => $adicional->id,
                    'description' => "Adicional: ".$adicional->nome,
                    'quantity' => $item->quantidade,
                    'amount' => $adicional->preco,
                    'weight' => '0',
                    'shippingCost' => '0',
                    'width' => '0',
                    'height' => '0',
                    'length' => '0',
                ];
            }
        }
        $data['items'][] = [
            'id' => 0,
            'description' => 'Entrega',
            'quantity' => '1',
            'amount' => $pedido->frete,
            'weight' => '0',
            'shippingCost' => '0',
            'width' => '0',
            'height' => '0',
            'length' => '0',
        ];


        $checkout = PagSeguro::checkout()->createFromArray($data);
        $credentials = PagSeguro::credentials()->get();
        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information


//        dd($data);
        $pagseguro_code = $information->getCode();
        $pagseguro_link = $information->getLink();

        if(!empty($pedido)){
            $pedido->codigo_pagseguro = $pagseguro_code;
        }
        $pedido->save();

        return redirect($pagseguro_link);
    }

    function notificacao(){
//        dd($request->all());
//        $credentials = PagSeguro::credentials()->get();
//        $transaction = PagSeguro::transaction()->get("53F78D39-1FBC-4E72-86F9-C79EE8F64447", $credentials);
//        $information = $transaction->getInformation();
//        dd($information);


        $pedido = Pedido::where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        $email = Auth::user()->email;

        $itens_pedido = ItensPedido::where('id_pedido', $pedido->id)->get();

        //email pra quem comprou
        Mail::send('emails.pedido', ['pedido' => $pedido, 'itens_pedido' => $itens_pedido], function($message) use ($email)
        {
            $message->subject('Confirmação de Pedido na Vegwrap');
            $message->from('pedido@vegwrap.com.br', 'Vegwrap');
            $message->to($email);
        });

        //email admin
        Mail::send('emails.confirmacaoPedido', ['pedido' => $pedido, 'itens_pedido' => $itens_pedido], function($message)
        {
            $message->subject('Novo Pedido na Vegwrap');
            $message->from('pedido@vegwrap.com.br', 'Vegwrap');
            $message->to('pedido@vegwrap.com.br', 'Vegwrap');
            $message->cc('renan.pupin@gmail.com');
        });

        return view('notificacao_pagamento');
    }
}
