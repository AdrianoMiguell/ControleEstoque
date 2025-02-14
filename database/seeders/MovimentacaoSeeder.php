<?php

namespace Database\Seeders;

use App\Models\Movimentacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimentacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('movimentacao')->insert([
        // ]);
        Movimentacao::factory()->count(25)->create();
    }
}
