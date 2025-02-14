<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeEstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unidade_estoques')->insert([
            [
                'descricao' => 'Quilos',
                'sigla' => 'kg',
                'isGlobal' => true,
                'user_id' => null,
            ],
            [
                'descricao' => 'Caixa',
                'sigla' => 'cx',
                'isGlobal' => true,
                'user_id' => null,
            ],
            [
                'descricao' => 'Lata',
                'sigla' => 'lt',
                'isGlobal' => true,
                'user_id' => null,
            ],
            [
                'descricao' => 'Pacote',
                'sigla' => 'pc',
                'isGlobal' => true,
                'user_id' => null,
            ],
            [
                'descricao' => 'Saco',
                'sigla' => 'sc',
                'isGlobal' => true,
                'user_id' => null,
            ],
            [
                'descricao' => 'Litros',
                'sigla' => 'L',
                'isGlobal' => false,
                'user_id' => 2,
            ],
            [
                'descricao' => 'Sacos',
                'sigla' => 'SC',
                'isGlobal' => false,
                'user_id' => 2,
            ],
            [
                'descricao' => 'Pacotes',
                'sigla' => 'PC',
                'isGlobal' => false,
                'user_id' => 2,
            ],
        ]);
    }
}
