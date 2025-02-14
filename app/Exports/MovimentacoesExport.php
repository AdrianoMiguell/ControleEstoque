<?php

namespace App\Exports;

use App\Models\Movimentacao;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MovimentacoesExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }


    public function query()
    {
        return $this->query ?: Movimentacao::query()
            ->join('produtos', 'movimentacoes.produto_id', '=', 'produtos.id')
            ->leftJoin('destinos', 'movimentacoes.destino_id', '=', 'destinos.id')
            ->leftJoin('fornecedors', 'movimentacoes.fornecedor_id', '=', 'fornecedors.id')
            ->select(
                'movimentacoes.id',
                DB::raw("CASE WHEN movimentacoes.tipo = '0' THEN 'Saída' ELSE 'Entrada' END as tipo"),
                'movimentacoes.quantidade',
                'movimentacoes.valor_unitario',
                'movimentacoes.valor_total',
                'produtos.nome as produto',
                'destinos.nome as destino',
                'fornecedors.nome as fornecedor',
            );
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo',
            'Quantidade',
            'Valor Unitario',
            'Valor Total',
            'Produto',
            'Destino',
            'Fornecedor',
        ];
    }
}
