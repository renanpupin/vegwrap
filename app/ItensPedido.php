<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{

    protected $table = "itens_pedido";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_pedido', 'id_produto', 'quantidade'
    ];

    public function Produto()
    {
        return $this->hasOne('\App\Produto','id','id_produto');
    }

}
