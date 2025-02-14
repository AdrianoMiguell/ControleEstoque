<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\UnidadeEstoque;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $unidades_estoque = UnidadeEstoque::all();
        $produtos = Produto::all();
        // dd($produtos);

        return view('admin.pages.view_produtos', compact('produtos', 'unidades_estoque'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $request->validate(
            [
                'nome' => 'required|string|max:50',
                'descricao' => 'max:500',
                'preco' => 'required:integer',
                'estoque' => 'required|integer',
                'unidade_estoque_id' => 'required',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.string' => 'O campo nome deve ser um texto.',
                'nome.max' => 'O campo nome não pode ter mais de 50 caracteres.',
                'descricao.max' => 'O campo descrição não pode ter mais de 500 caracteres.',
                'preco.required' => 'O campo preço é obrigatório.',
                'preco.integer' => 'O campo preço deve ser um número inteiro.',
                'estoque.required' => 'O campo estoque é obrigatório.',
                'estoque.integer' => 'O campo estoque deve ser um número inteiro.',
                'unidade_estoque_id.required' => 'Você deve selecionar uma unidade de estoque.',
            ]
        );

        $produto = $request->except('_token');

        try {
            Produto::create($produto);

            return back()->with('status', "Produto cadastrado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao cadastrar produto.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:50',
                'descricao' => 'max:500',
                'preco' => 'required|integer',
                'estoque' => 'required|integer',
                'unidade_estoque_id' => 'required',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.string' => 'O campo nome deve ser um texto.',
                'nome.max' => 'O campo nome não pode ter mais de 50 caracteres.',
                'descricao.max' => 'O campo descrição não pode ter mais de 500 caracteres.',
                'preco.required' => 'O campo preço é obrigatório.',
                'preco.integer' => 'O campo preço deve ser um número inteiro.',
                'estoque.required' => 'O campo estoque é obrigatório.',
                'estoque.integer' => 'O campo estoque deve ser um número inteiro.',
                'unidade_estoque_id.required' => 'Você deve selecionar uma unidade de estoque.',
            ]
        );

        $produto = Produto::find($request->produto_id);

        if (!$produto) {
            return back()->withErrors("Produto não encontrado.");
        }

        try {
            $produto->update($request->except('_token'));

            return back()->with('status', "Produto atualizado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao atualizar o produto.");
        }
    }

    public function delete(Produto $produto)
    {
        try {
            $produto->delete();
            return back()->with('status', 'Produto deletado com sucesso.');
        } catch (\Throwable $t) {
            return back()->withErrors('Erro ao deletar o produto.');
        }
    }
}
