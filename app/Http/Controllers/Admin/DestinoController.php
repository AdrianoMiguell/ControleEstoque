<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use App\Models\Movimentacao;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:75',
                'tipo' => 'required|string|max:25',
                'descricao' => 'required|string|max:500',
            ],
            [
                'nome.required' => 'O nome não foi informado.',
                'nome.string' => 'O nome não é um texto.',
                'nome.max' => 'O nome tem um limite de 25 caracteres.',
                'tipo.required' => 'O Tipo não foi informado.',
                'tipo.string' => 'O Tipo não é um texto.',
                'tipo.max' => 'O tipo tem um limite de 25 caracteres.',
                'descricao.required' => 'A Descricao não foi informado.',
                'descricao.string' => 'A Descricao não é um texto.',
                'descricao.max' => 'A Descricao tem um limite de 25 caracteres.',
            ]
        );

        $destino = $request->except('_token');

        try {
            Destino::create($destino);

            return back()->with('status', "O Destino foi cadastrado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao registrar a destinação.");
        }
    }

    public function edit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:75',
                'tipo' => 'required|string|max:25',
                'descricao' => 'required|string|max:500',
            ],
            [
                'nome.required' => 'O nome não foi informado.',
                'nome.string' => 'O nome não é um texto.',
                'nome.max' => 'O nome tem um limite de 25 caracteres.',
                'tipo.required' => 'O Tipo não foi informado.',
                'tipo.string' => 'O Tipo não é um texto.',
                'tipo.max' => 'O tipo tem um limite de 25 caracteres.',
                'descricao.required' => 'A Descricao não foi informado.',
                'descricao.string' => 'A Descricao não é um texto.',
                'descricao.max' => 'A Descricao tem um limite de 25 caracteres.',
            ]
        );

        $destino = Destino::find($request->destino_id);

        try {
            $destino->update($request->except('_token'));

            return back()->with('status', "O Destino foi atualizado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao atualizar a destinação.");
        }
    }

    public function delete(Destino $destino)
    {

        $movimentacao_exists = Movimentacao::where('destino_id', $destino->id)->exists();

        if($movimentacao_exists) {
            return back()->withErrors("Não é possivel deletar essa destinação pois está em uso.");
        }

        try {
            $destino->delete();
            return back()->with('status', "Destino deletado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao deletar a destinação.");
        }
    }
}
