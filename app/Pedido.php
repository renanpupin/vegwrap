<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = "pedidos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'subtotal', 'frete', 'total', 'nome', 'telefone', 'endereco', 'bairro', 'cep', 'observacao', 'metodo_pagamento', 'codigo_pagseguro'
    ];

}
