<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->float('subtotal');
            $table->float('frete');
            $table->float('total');
            $table->string('nome');
            $table->string('telefone');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cep');
            $table->string('observacao');
            $table->string('metodo_pagamento');
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
        Schema::drop('pedidos');
    }
}
