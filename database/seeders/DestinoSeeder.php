<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('destinos')->insert([
            [
                'nome' => 'Fazenda Boa Vista',
                'tipo' => 'Cliente',
                'descricao' => 'Uma fazenda que compra produtos para revenda local.',
                'user_id' => 1
            ],
            [
                'nome' => 'Campo 1',
                'tipo' => 'Setor Interno',
                'descricao' => 'Setor de plantio de grãos na Fazenda Boa Vista.',
                'user_id' => 1
            ],
            [
                'nome' => 'Campo 2',
                'tipo' => 'Setor Interno',
                'descricao' => 'Área destinada ao plantio de soja.',
                'user_id' => 2
            ],
            [
                'nome' => 'Silo de Grãos A',
                'tipo' => 'Silo',
                'descricao' => 'Armazenamento de grãos colhidos, aguardando processamento.',
                'user_id' => 2
            ],
            [
                'nome' => 'Cooperativa Agropecuária X',
                'tipo' => 'Cliente',
                'descricao' => 'Cooperativa que compra grandes lotes de grãos para revenda.',
                'user_id' => 2
            ],
            [
                'nome' => 'Transportadora AgroRápido',
                'tipo' => 'Terceirizado',
                'descricao' => 'Empresa responsável pelo transporte de produtos agrícolas entre as fazendas e mercados.',
                'user_id' => 2
            ],
            [
                'nome' => 'Fazenda Campo Verde',
                'tipo' => 'Cliente',
                'descricao' => 'Fazenda que adquire produtos agrícolas para uso próprio e revenda.',
                'user_id' => 2
            ],
            [
                'nome' => 'Usina Bioenergia',
                'tipo' => 'Exportação',
                'descricao' => 'Usina que importa matéria-prima como soja e milho para gerar biodiesel.',
                'user_id' => 1
            ]
        ]);
    }
}
