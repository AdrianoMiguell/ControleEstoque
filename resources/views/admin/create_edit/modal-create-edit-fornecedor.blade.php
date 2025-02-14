<?php

$estados = config('endereco.UF.nome');

?>

<!-- Button trigger modal -->
<button type="button" @class([
    'btn',
    'btn-main' => !isset($fornecedor->id),
    'btn-success' => isset($fornecedor->id),
]) data-bs-toggle="modal"
    data-bs-target="#modalCriarFornecedor{{ $fornecedor->id ?? Auth::user()->id }}">
    @if (isset($fornecedor))
        <i class="bi bi-pencil-square"></i>
    @else
        <i class="bi bi-plus"></i>
        <span>Fornecedor</span>
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="modalCriarFornecedor{{ $fornecedor->id ?? Auth::user()->id }}" tabindex="-1"
    aria-labelledby="modalCriarFornecedor{{ $fornecedor->id ?? Auth::user()->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCriarFornecedor{{ $fornecedor->id ?? Auth::user()->id }}Label">
                    @if (isset($fornecedor))
                        <i class="bi bi-pencil-square"></i>
                        <span>Fornecedor</span>
                    @else
                        <i class="bi bi-plus"></i>
                        <span>Fornecedor</span>
                    @endif
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ isset($fornecedor) ? route('edit.fornecedor') : route('create.fornecedor') }}">
                    @csrf

                    @if (isset($fornecedor))
                        @method('PUT')
                        <legend>Editar Fornecedor</legend>

                        <input type="hidden" name="fornecedor_id" value="{{ $fornecedor->id }}">
                    @else
                        <legend>Novo Fornecedor</legend>
                    @endif

                    <div class="mb-3">
                        <label for="f" class="form-label">Nome * </label>
                        <input type="text" class="form-control" name="nome" placeholder="nome" minlength="1"
                            maxlength="50" value="{{ $fornecedor->nome ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="f" class="form-label">Identificação * </label>
                        <div class="d-flex gap-3">
                            <input type="text" class="form-control" name="identificacao" placeholder="identificacao"
                                maxlength="25" value="{{ $fornecedor->identificacao ?? '' }}">
                            <select name="tipo_certific" class="form-select w-50">
                                <option value="cpf" @selected(isset($fornecedor) && strlen($fornecedor->identificacao) == 9)>CPF</option>
                                <option value="cnpj" @selected(isset($fornecedor) && strlen($fornecedor->identificacao) > 9)>CNPJ</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="f" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" name="telefone" placeholder="Telefone" minlength="9"
                            maxlength="25" value="{{ $fornecedor->telefone ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="f" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" minlength="8"
                            maxlength="255" value="{{ $fornecedor->email ?? '' }}">
                    </div>

                    <legend class="fs-5">Endereço</legend>

                    <div class="d-flex gap-3 mb-3">
                        <div style="flex-grow: 1;">
                            <label for="f" class="form-label">CEP * </label>
                            <input type="number" class="form-control" name="cep" placeholder="CEP" size="8"
                                value="{{ $fornecedor->cep ?? '' }}">
                        </div>
                        <div class="">
                            <label for="f" class="form-label">Estado * </label>
                            <select name="estado" class="form-select">
                                @foreach (config('endereco.UF.nome') as $key => $estado)
                                    <option value="{{ $estado }}" @selected(isset($fornecedor) && $fornecedor->estado == $estado)
                                        title="{{ $estado }}">
                                        {{ config('endereco.UF.sigla')[$key] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mb-3">
                        <div class="">
                            <label for="f" class="form-label">Cidade * </label>
                            <input type="text" class="form-control" name="cidade" placeholder="Cidade"
                                minlength="8" maxlength="255" value="{{ $fornecedor->cidade ?? '' }}">
                        </div>

                        <div class="">
                            <label for="f" class="form-label">Bairro * </label>
                            <input type="text" class="form-control" name="bairro" placeholder="Bairro"
                                minlength="8" maxlength="255" value="{{ $fornecedor->bairro ?? '' }}">
                        </div>

                        <div class="">
                            <label for="f" class="form-label">Rua * </label>
                            <input type="text" class="form-control" name="rua" placeholder="Rua"
                                minlength="8" maxlength="255" value="{{ $fornecedor->rua ?? '' }}">
                        </div>

                        <div class="">
                            <label for="f" class="form-label">Número * </label>
                            <input type="number" class="form-control" name="numero" placeholder="Número"
                                minlength="8" maxlength="255" value="{{ $fornecedor->numero ?? '' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fornecedor_complemento{{ $fornecedor->id ?? Auth::user()->id }}"
                            class="form-label">Complemento</label>
                        <textarea id="fornecedor_complemento{{ $fornecedor->id ?? Auth::user()->id }}" class="form-control"
                            name="complemento" cols="30" rows="2" minlength="10" maxlength="500">{{ $fornecedor->complemento ?? '' }}</textarea>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="d-flex justify-content-end">
                        @if (isset($fornecedor))
                            <button class="btn btn-success">Editar</button>
                        @else
                            <button class="btn btn-primary">Enviar</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
