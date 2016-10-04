<?php

use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('produtos')->insert(array(
            array(
                'id' => 1,
                'nome' => "Veneza",
                'descricao' => "Alface, cenoura, tomate, maionese e azeite de oliva",
                'preco' => 3,
                'tipo' => "wrap_salgado"
            ),
            array(
                'id' => 2,
                'nome' => "Bahamas",
                'descricao' => "Milho, requeijão, mussarela, alface e azeite de oliva",
                'preco' => 3.50,
                'tipo' => "wrap_salgado"
            ),
            array(
                'id' => 3,
                'nome' => "Ibiza",
                'descricao' => "Milho, requeijão, azeitona, repolho roxo e azeite de oliva",
                'preco' => 3.75,
                'tipo' => "wrap_salgado"
            ),
            array(
                'id' => 4,
                'nome' => "Bora Bora",
                'descricao' => "Espinafre, ricota, requeijão, azeitona e azeite de oliva",
                'preco' => 4,
                'tipo' => "wrap_salgado"
            ),
            array(
                'id' => 5,
                'nome' => "Ilhabela",
                'descricao' => "Rúcula, tomate seco, maionese, mussarela e azeite de oliva",
                'preco' => 4.75,
                'tipo' => "wrap_salgado"
            ),
            array(
                'id' => 7,
                'nome' => "Santorini",
                'descricao' => "Brigadeiro",
                'preco' => 3,
                'tipo' => "wrap_doce"
            ),
            array(
                'id' => 8,
                'nome' => "Madagascar",
                'descricao' => "Banana com canela",
                'preco' => 3.50,
                'tipo' => "wrap_doce"
            ),
            array(
                'id' => 9,
                'nome' => "Marajó",
                'descricao' => "Prestígio",
                'preco' => 4,
                'tipo' => "wrap_doce"
            ),
            array(
                'id' => 10,
                'nome' => "Abacaxi",
                'descricao' => "",
                'preco' => 4,
                'tipo' => "suco"
            ),
            array(
                'id' => 11,
                'nome' => "Laranja",
                'descricao' => "",
                'preco' => 4,
                'tipo' => "suco"
            ),
            array(
                'id' => 12,
                'nome' => "Maracujá",
                'descricao' => "",
                'preco' => 4,
                'tipo' => "suco"
            ),
            array(
                'id' => 13,
                'nome' => "Morango",
                'descricao' => "",
                'preco' => 4,
                'tipo' => "suco"
            ),
        ));
    }
}
//php artisan db:seed --class=ProdutosSeeder