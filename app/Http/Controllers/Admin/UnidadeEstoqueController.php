<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\UnidadeEstoque;
use Illuminate\Http\Request;

class UnidadeEstoqueController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'descricao' => 'required|string|max:500',
                'sigla' => 'required|string|max:10',
            ],
            [
                'descricao.required' => 'A descrição é obrigatória.',
                'descricao.string' => 'A descrição deve ser um texto válido.',
                'descricao.max' => 'A descrição não pode ter mais de 500 caracteres.',
                'sigla.required' => 'A sigla é obrigatória.',
                'sigla.string' => 'A sigla deve ser um texto válido.',
                'sigla.max' => 'A sigla não pode ter mais de 10 caracteres.',
            ]
        );

        $total_unidades_estoque = UnidadeEstoque::count();

        if ($total_unidades_estoque >= 20) {
            return back()->withErrors("Você só pode registrar até 20 Unidade de Estoque.");
        }

        $unidade_estoque = $request->except('_token');
        $unidade_estoque['isGlobal'] = false;

        try {
            UnidadeEstoque::create($unidade_estoque);

            return back()->with('status', "A Unidade de Estoque foi cadastrado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao registrar nova Unidade de Estoque.");
        }
    }

    public function edit(Request $request)
    {
        $request->validate(
            [
                'descricao' => 'required|string|max:500',
                'sigla' => 'required|string|max:10',
            ],
            [
                'descricao.required' => 'A descrição é obrigatória.',
                'descricao.string' => 'A descrição deve ser um texto válido.',
                'descricao.max' => 'A descrição não pode ter mais de 500 caracteres.',
                'sigla.required' => 'A sigla é obrigatória.',
                'sigla.string' => 'A sigla deve ser um texto válido.',
                'sigla.max' => 'A sigla não pode ter mais de 10 caracteres.',
            ]
        );

        $unidade_estoque = UnidadeEstoque::find($request->unidade_estoque_id);

        try {
            $unidade_estoque->update($request->except('_token'));

            return back()->with('status', "A Unidade de Estoque foi atualizada com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao atualizar a Unidade de Estoque.");
        }
    }

    public function delete(UnidadeEstoque $unid)
    {
        $produto_exists = Produto::where('unidade_estoque_id', $unid->id)->exists();

        if ($produto_exists) {
            return back()->withErrors('Erro ao deletar a unidade de estoque pois está em uso.');
        }

        try {
            $unid->delete();
            return back()->with('status', 'Unidade de estoque deletada com sucesso.');
        } catch (\Throwable $t) {
            return back()->withErrors('Erro ao deletar unidade de estoque.');
        }
    }
}
