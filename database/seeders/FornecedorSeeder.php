<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fornecedors')->insert([
            [
                'nome' => 'DistAgro',
                'identificacao' => '06215692000171',
                'telefone' => '6727874758',
                'email' => 'distagro@gmail.com',
                'cep' => '78142320',
                'estado' => 'Mato Grosso',
                'cidade' => 'Vila Várzea Grande',
                'bairro' => 'Vila Maristela',
                'rua' => 'Rua Um',
                'numero' => '150',
                'user_id' => 2
            ],
            [
                'nome' => 'AvantAgro',
                'identificacao' => '53523712000151',
                'telefone' => '6138690461',
                'email' => 'avantagro@gmail.com',
                'cep' => '78142320',
                'estado' => 'Mato Grosso',
                'cidade' => 'Vila Várzea Grande',
                'bairro' => 'Vila Maristela',
                'rua' => 'Rua Um',
                'numero' => '150',
                'user_id' => 2
            ]
        ]);
    }
}
