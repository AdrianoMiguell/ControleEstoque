<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ValidationHelper;
use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class FornecedorController extends Controller
{
    public function create(StoreFornecedorRequest $request)
    {
        $request->validated();

        $validate_identificacion = true;
        $request['identificacao'] = preg_replace('/[^0-9]/', '', $request->identificacao);

        if ($request->tipo_certific == "cpf") {
            if (!ValidationHelper::validateCpf($request->identificacao)) {
                $validate_identificacion = false;
            }
        } else {
            if (!ValidationHelper::validateCnpj($request->identificacao)) {
                $validate_identificacion = false;
            }
        }

        if (!$validate_identificacion || Fornecedor::where('identificacao', $request->identificacao)->exists()) {
            return back()->withErrors(strtoupper($request->tipo_certific) . " inválido ou já em uso, verifique se foi informado corretamente.");
        }

        // dd($request);

        $validate_endereco = ValidationHelper::validateCep($request->cep);

        if (!$validate_endereco) {
            return back()->withErrors("Erro ao encontrar cep, certifique-se de que foi informado corretamente.");
        }

        $fornecedor = $request->except('_token', 'tipo_certific');

        try {
            Fornecedor::create($fornecedor);

            return back()->with('status', "Fornecedor cadastrado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao cadastrar Fornecedor.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreFornecedorRequest $request)
    {
        $request->validated();

        $validate_identificacion = true;
        $request['identificacao'] = preg_replace('/[^0-9]/', '', $request->identificacao);

        if ($request->tipo_certific == "cpf") {
            if (!ValidationHelper::validateCpf($request->identificacao)) {
                $validate_identificacion = false;
            }
        } else {
            if (!ValidationHelper::validateCnpj($request->identificacao)) {
                $validate_identificacion = false;
            }
        }

        // Verificar se a identificação é válida ou está sendo usada por outro registro
        if (!$validate_identificacion || Fornecedor::where('identificacao', $request->identificacao)->where('id', '!=', $request->fornecedor_id)->exists()) {
            return back()->withErrors(strtoupper($request->tipo_certific) . " inválido ou já em uso, verifique se foi informado corretamente.");
        }

        $validate_endereco = ValidationHelper::validateCep($request->cep);

        if (!$validate_endereco) {
            return back()->withErrors("Erro ao encontrar cep, certifique-se de que foi informado corretamente.");
        }

        try {
            // Buscar o fornecedor pelo ID
            $fornecedor = Fornecedor::findOrFail($request->fornecedor_id);

            // Atualizar os dados do fornecedor
            $fornecedor->update($request->except('_token', 'tipo_certific'));

            return back()->with('status', "Fornecedor atualizado com sucesso.");
        } catch (\Throwable $th) {
            return back()->withErrors("Erro ao atualizar Fornecedor.");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Fornecedor $fornecedor)
    {
        try {
            $fornecedor->delete();
            return back()->with('status', 'Fornecedor deletado com sucesso.');
        } catch (\Throwable $t) {
            return back()->withErrors('Erro ao deletar o Fornecedor.');
        }
    }
}
