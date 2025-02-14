<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Fornecedor;
use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\UnidadeEstoque;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $sectionAtiva = request()->query('section', 'section_produtos');

        $unidades_estoque = [];
        $produtos = [];
        $destinos = [];
        $fornecedores = [];
        $movimentacoes = [];

        $all_unidades_estoque = [];
        $all_produtos = [];
        $all_destinos = [];
        $all_fornecedores = [];
        $all_movimentacoes = [];

        if ($sectionAtiva === 'section_produtos') {
            $queryProdutos = Produto::query()
                ->join('unidade_estoques', 'produtos.unidade_estoque_id', '=', 'unidade_estoques.id')
                ->select('produtos.*', 'unidade_estoques.descricao as unidade_descricao', 'unidade_estoques.sigla as unidade_sigla');

            $queryUnidades = UnidadeEstoque::query()
                ->where(function ($q) use ($user) {
                    $q->where('isGlobal', true)->orWhere('user_id', $user->id);
                });

            if ($search = request('search')) {
                $searchableColumnsProdutos = [
                    'produtos.nome',
                    'produtos.descricao',
                    'produtos.preco',
                    'produtos.estoque',
                    'unidade_estoques.descricao',
                    'unidade_estoques.sigla'
                ];

                $queryProdutos->where(function ($q) use ($search, $searchableColumnsProdutos) {
                    foreach ($searchableColumnsProdutos as $column) {
                        $q->orWhere($column, 'LIKE', "%$search%");
                    }
                });

                $searchableColumnsUnidades = ['descricao', 'sigla'];
                $queryUnidades->where(function ($q) use ($search, $searchableColumnsUnidades) {
                    foreach ($searchableColumnsUnidades as $column) {
                        $q->orWhere($column, 'LIKE', "%$search%");
                    }
                });
            }

            if ($orderBy = request('orderByProdutos')) {
                $tipoOrder = request('tipoOrderByProdutos', 'asc');
                if (in_array($orderBy, ['nome', 'preco', 'estoque'])) {
                    $queryProdutos->orderBy("produtos.$orderBy", $tipoOrder);
                }

                $queryUnidades->orderBy('descricao', 'asc');
            }

            $produtos = $queryProdutos->paginate(15)->appends(request()->query());
            $unidades_estoque = $queryUnidades->limit(20)->get();
        }


        if ($sectionAtiva === 'section_destinos') {
            $queryDestinos = Destino::query();

            if ($search = request('search')) {
                $searchableColumnsDestino = [
                    'nome',
                    'tipo',
                    'descricao'
                ];

                $queryDestinos->where(function ($q) use ($searchableColumnsDestino, $search) {
                    foreach ($searchableColumnsDestino as $column) {
                        $q->orWhere($column, 'LIKE', "%$search%");
                    }
                });
            }

            if ($orderBy = request('orderByDestinos')) {
                $tipoOrderBy = request('tipoOrderByDestinos');

                $queryDestinos->orderBy($orderBy, $tipoOrderBy);
            }

            $destinos = $queryDestinos->paginate(15)->appends(request()->query());
        }

        if ($sectionAtiva === 'section_fornecedores') {
            $queryFornecedores = Fornecedor::query();

            if ($search = request('search')) {
                $searchableColumnsFornecs = [
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
                ];

                $queryFornecedores->where(function ($q) use ($search, $searchableColumnsFornecs) {
                    foreach ($searchableColumnsFornecs as $column) {
                        $q->orWhere($column, 'LIKE', "%$search%");
                    }
                });
            }

            if ($orderBy = request('orderByFornec')) {
                $tipoOrderBy = request('tipoOrderByFornec');

                $queryFornecedores->orderBy($orderBy, $tipoOrderBy);
            }

            $fornecedores = $queryFornecedores->paginate(15)->appends(request()->query());
        }

        if ($sectionAtiva === 'section_movimentacoes') {
            $filter = request('filter'); 

            $query = Movimentacao::query();

            if ($filter === 'saidas-30-dias') {
                $query->where('tipo', '0')->where('created_at', '>=', now()->subDays(30));
            } elseif ($filter === 'saidas-6-meses') {
                $query->where('tipo', '0')->where('created_at', '>=', now()->subMonths(6));
            } elseif ($filter === 'maiores-saidas') {
                $query->where('tipo', '0')->orderBy('quantidade', 'desc');
            } elseif ($filter === 'maiores-entradas') {
                $query->where('tipo', '1')->orderBy('quantidade', 'desc');
            } 
            
            // Paginação
            $movimentacoes = $query->paginate(20);

            $all_destinos = Destino::all();
            $all_fornecedores = Fornecedor::all();
            $all_produtos = Produto::all();
        }

        return view('admin.dashboard_admin', compact(
            'unidades_estoque',
            'destinos',
            'produtos',
            'fornecedores',
            'movimentacoes',
            'sectionAtiva',
            'all_unidades_estoque',
            'all_produtos',
            'all_destinos',
            'all_fornecedores',
            'all_movimentacoes',
        ));
    }
}
