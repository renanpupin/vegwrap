<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdicionaisItemPedido extends Model
{
    protected $table = "adicionais_itens_pedido";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'preco', 'id_item_pedido'
    ];

    public function ItemPedido()
    {
        return $this->hasOne('\App\ItensPedido','id', 'id_item_pedido');
    }

}
