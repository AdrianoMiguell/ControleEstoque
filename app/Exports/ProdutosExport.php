<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdutosExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query ?: Produto::query()->join('unidade_estoques', 'produtos.unidade_estoque_id', '=', 'unidade_estoques.id')
            ->select(
                'produtos.id',
                'produtos.nome',
                'produtos.descricao',
                'produtos.preco',
                'produtos.estoque',
                'unidade_estoques.descricao as unidade_estoque',
            );
    }

    public function headings(): array
    {
        return ['ID', 'Nome', 'Descrição', 'Preço', 'Estoque', 'Unidade de Estoque'];
    }
}
