<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Produto;
use App\Pedido;
use App\ItensPedido;
use Auth;

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

        return view('home')->with('wraps_salgados',$wraps_salgados)->with('wraps_doces',$wraps_doces)->with('sucos',$sucos);
    }

    public function pedido(Request $request)
    {
        $subtotal = 0;
        $frete = 3;

//        dd($request->all());
//        dd($request->get("wrap-select"));

        $selected_wraps = $request->get("wrap-select");
        if($selected_wraps != null) {
            foreach ($selected_wraps as $wrap) {
                $preco = Produto::find($wrap)->preco;
                $subtotal += ($preco * $request->get("wrap-" . $wrap . "-qtd"));
            }
        }


        $selected_sucos = $request->get("suco-select");
        if($selected_sucos != null){
            foreach($selected_sucos as $suco){
                $preco = Produto::find($suco)->preco;
                $subtotal += ($preco * $request->get("suco-".$wrap."-qtd"));
            }
        }


        $pedido = Pedido::Create([
            'id_user' => Auth::user()->id,
            'subtotal' => $subtotal,
            'frete' => $frete,
            'total' => $subtotal + $frete,
            'nome' => $request->get("nome"),
            'telefone' => $request->get("telefone"),
            'endereco' => $request->get("endereco"),
            'bairro' => $request->get("bairro"),
            'cep' => $request->get("cep"),
            'observacao' => $request->get("observacao"),
            'metodo_pagamento' => "",
        ]);


        $selected_wraps = $request->get("wrap-select");
        if($selected_wraps != null) {
            foreach ($selected_wraps as $wrap) {
                ItensPedido::Create([
                    'id_pedido' => $pedido->id,
                    'id_produto' => $wrap,
                    'quantidade' => $request->get("wrap-" . $wrap . "-qtd")
                ]);
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
                $item->delete();
            }
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

        //mailgun
        //https://jamie.sh/tutorials/7/setting-up-mailgun-with-laravel-5

        return redirect('/pedido/'.$id);
    }

    function pagarPagseguro($id){

        $pedido = Pedido::find($id);

        if(!empty($pedido)){
            $pedido->metodo_pagamento = "pagamento_pagseguro";
        }
        $pedido->save();

        return redirect('/pedido/'.$id);
    }
}
