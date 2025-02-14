<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movimentacao;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovimentacaoRequest;
use App\Http\Requests\UpdateMovimentacaoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createEntrada(Request $request)
    {
        $request->validate(
            [
                'fornecedor_id' => 'required',
                'produto_id' => 'required',
                'quantidade' => 'required',
            ],
            [
                'fornecedor_id.required' => 'O Fornecedor não foi informado.',
                'produto_id.required' => 'O Produto não foi informado.',
                'quantidade.required' => 'A Quantidade não foi informada.',
            ]
        );

        $entrada = $request->except('_token');

        $produto = Produto::find($entrada['produto_id']);

        $novoEstoque = $produto['estoque'] + $entrada['quantidade'];
        $valorUnit = $produto['preco'];
        $valorTotal = $valorUnit * $entrada['quantidade'];

        try {
            Produto::where('id', $produto['id'])->update(['estoque' => $novoEstoque]);
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao registrar movimentação de produto.");
        }

        $entrada['tipo'] = '1';
        $entrada['valor_unitario'] = $valorUnit;
        $entrada['valor_total'] = $valorTotal;

        try {
            Movimentacao::create($entrada);

            return back()->with('status', "Movimentação realizada com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao registrar movimentação de produto.");
        }
    }

    public function createSaida(Request $request)
    {
        $request->validate(
            [
                'destino_id' => 'required',
                'produto_id' => 'required',
                'quantidade' => 'required',
            ],
            [
                'destino_id.required' => 'O Destino dos produtos não foi informado.',
                'produto_id.required' => 'O Produto não foi informado.',
                'quantidade.required' => 'A Quantidade não foi informada.',
            ]
        );

        $saida = $request->except('_token');

        $produto = Produto::find($saida['produto_id']);

        $novoEstoque = $produto['estoque'] - $saida['quantidade'];

        if ($novoEstoque < 0) {
            $message = "só há " . $produto['estoque'] . " produtos.";
            if ($produto['estoque'] == 1) {
                $message = "só há " . $produto['estoque'] . " produto.";
            } elseif ($produto['estoque'] == 0) {
                $message = "não há nenhum produto.";
            }

            return back()->withErrors("Não é possivel movimentar a quantidade desejada, pois no estoque " . $message);
        }

        $valorUnit = $produto['preco'] * -1;
        $valorTotal = $valorUnit * $saida['quantidade'];

        try {
            Produto::where('id', $produto['id'])->update(['estoque' => $novoEstoque]);
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao registrar movimentação de produto.");
        }

        $saida['tipo'] = '0';
        $saida['valor_unitario'] = $valorUnit;
        $saida['valor_total'] = $valorTotal;

        try {
            Movimentacao::create($saida);

            return back()->with('status', "Movimentação realizada com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao registrar movimentação de produto.");
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editEntrada(Movimentacao $movimentacao)
    {
        //
    }

    public function editSaida(Movimentacao $movimentacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEntrada(Movimentacao $movimentacao)
    {
        //
    }

    public function deleteSaida(Movimentacao $movimentacao)
    {
        //
    }
}
