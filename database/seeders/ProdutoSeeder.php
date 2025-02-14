<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produtos')->insert([
            [
                'nome' => 'Fertilizante',
                'descricao' => 'Produto com nutrientes para o solo.',
                'preco' => 23.50,
                'estoque' => 1000,
                'unidade_estoque_id' => 5,
                'user_id' => 2
            ],
            [
                'nome' => 'Ração',
                'descricao' => 'Produto alimenticio para animais.',
                'preco' => 12.50,
                'estoque' => 1000,
                'unidade_estoque_id' => 1,
                'user_id' => 2
            ],
            [
                'nome' => 'Manga',
                'descricao' => 'Fruta para venda internacional.',
                'preco' => 1.50,
                'estoque' => 1000,
                'unidade_estoque_id' => 1,
                'user_id' => 2
            ],
            [
                'nome' => 'Herbicida',
                'descricao' => 'Produto para controle de ervas daninhas.',
                'preco' => 45.00,
                'estoque' => 500,
                'unidade_estoque_id' => 6,
                'user_id' => 2
            ],
            [
                'nome' => 'Adubo Orgânico',
                'descricao' => 'Fertilizante natural para plantações.',
                'preco' => 30.00,
                'estoque' => 300,
                'unidade_estoque_id' => 7,
                'user_id' => 2
            ],
            [
                'nome' => 'Sementes de Milho',
                'descricao' => 'Sementes de milho híbrido de alta produtividade.',
                'preco' => 8.50,
                'estoque' => 2000,
                'unidade_estoque_id' => 8,
                'user_id' => 2
            ],
            [
                'nome' => 'Inseticida Biológico',
                'descricao' => 'Produto natural para controle de pragas.',
                'preco' => 55.75,
                'estoque' => 400,
                'unidade_estoque_id' => 6,
                'user_id' => 2
            ],
            [
                'nome' => 'Sal Mineralizado',
                'descricao' => 'Suplemento mineral para bovinos.',
                'preco' => 20.00,
                'estoque' => 1500,
                'unidade_estoque_id' => 7,
                'user_id' => 2
            ],
        ]);
    }
}
