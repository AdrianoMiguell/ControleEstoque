<?php

namespace App\Http\Controllers;

use App\Exports\DestinosExport;
use App\Exports\FornecedoresExport;
use App\Exports\MovimentacoesExport;
use App\Exports\ProdutosExport;
use App\Exports\UnidadesEstoqueExport;
use App\Models\Destino;
use App\Models\Fornecedor;
use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\UnidadeEstoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportProdutos(Request $request)
    {
        $query = Produto::query()
            ->join('unidade_estoques', 'produtos.unidade_estoque_id', '=', 'unidade_estoques.id')
            ->select(
                'produtos.id',
                'produtos.nome',
                'produtos.descricao',
                'produtos.preco',
                'produtos.estoque',
                'unidade_estoques.descricao as unidade_estoque',
            );

        // Verifica se há filtros
        if ($request->has('filtered') && $request->filtered == 'true') {
            if ($search = $request->query('search')) {
                $query->where(function ($q) use ($search) {
                    $q->where('produtos.nome', 'LIKE', "%$search%")
                        ->orWhere('produtos.descricao', 'LIKE', "%$search%")
                        ->orWhere('unidade_estoques.descricao', 'LIKE', "%$search%");
                });
            }
        }

        return Excel::download(new ProdutosExport($query), 'produtos.xlsx');
    }

    public function exportFornecedores(Request $request)
    {
        $searchableColumnsFornecs = [
            'id',
            'nome',
            'identificacao',
            'telefone',
            'email',
            'cep',
            'estado',
            'cidade',
            'bairro',
            'rua',
            'numero',
            'complemento'
        ];

        $query = Fornecedor::query()->select($searchableColumnsFornecs);

        // Verifica se há filtros
        if ($request->has('filtered') && $request->filtered == 'true') {
            if ($search = $request->query('search')) {


                $query->where(function ($q) use ($search, $searchableColumnsFornecs) {
                    foreach ($searchableColumnsFornecs as $column) {
                        $q->orWhere($column, 'LIKE', "%$search%");
                    }
                });
            }
        }

        return Excel::download(new FornecedoresExport($query), 'fornecedores.xlsx');
    }

    public function exportDestinos(Request $request)
    {
        $searchableColumnsDestinos = [
            'id',
            'nome',
            'tipo',
            'descricao',
        ];

        $query = Destino::query()->select(
            'nome',
            'tipo',
            'descricao',
        );

        // Verifica se há filtros
        if ($request->has('filtered') && $request->filtered == 'true') {
            if ($search = $request->query('search')) {
                $query->where(function ($q) use ($search, $searchableColumnsDestinos) {
                    foreach ($searchableColumnsDestinos as $column) {
                        $q->orWhere($column, 'LIKE', "%$search%");
                    }
                });
            }
        }

        return Excel::download(new DestinosExport($query), 'destinos.xlsx');
    }

    public function exportUnidades()
    {
        $searchableColumnsUnidades = [
            'id',
            'descricao',
            'sigla',
        ];

        $query = UnidadeEstoque::query()->select($searchableColumnsUnidades);

        return Excel::download(new UnidadesEstoqueExport($query), 'unidades_estoque.xlsx');
    }


    public function exportMovimentacoes(Request $request)
    {
        $query = Movimentacao::query()
            ->join('produtos', 'movimentacaos.produto_id', '=', 'produtos.id')
            ->leftJoin('destinos', 'movimentacaos.destino_id', '=', 'destinos.id')
            ->leftJoin('fornecedors', 'movimentacaos.fornecedor_id', '=', 'fornecedors.id')
            ->select(
                'movimentacaos.id',
                DB::raw("CASE WHEN movimentacaos.tipo = '0' THEN 'Saída' ELSE 'Entrada' END as tipo"),
                'movimentacaos.quantidade',
                'movimentacaos.valor_unitario',
                'movimentacaos.valor_total',
                'produtos.nome as produto',
                'destinos.nome as destino',
                'fornecedors.nome as fornecedor'
            );

        if ($request->has('filtered') && $request->filtered == 'true') {
            if ($filter = $request->query('filter')) {
                if ($filter === 'saidas-30-dias') {
                    $query->where('movimentacaos.tipo', '0')->where('movimentacaos.created_at', '>=', now()->subDays(30));
                } elseif ($filter === 'saidas-6-meses') {
                    $query->where('movimentacaos.tipo', '0')->where('movimentacaos.created_at', '>=', now()->subMonths(6));
                } elseif ($filter === 'maiores-saidas') {
                    $query->where('movimentacaos.tipo', '0')->orderBy('movimentacaos.quantidade', 'desc');
                }
            }
        }

        return Excel::download(new MovimentacoesExport($query), 'movimentacoes.xlsx');
    }
}
