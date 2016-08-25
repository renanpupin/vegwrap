<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdicionaisItemPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicionais_itens_pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->float('preco');
            $table->integer('id_item_pedido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('adicionais_itens_pedido');
    }
}
