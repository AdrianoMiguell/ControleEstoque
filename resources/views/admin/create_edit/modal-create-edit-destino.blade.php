<?php
$tipo_destino = config('auth.admin.destinos.tipo');
?>

<!-- Button trigger modal -->
<button type="button" @class([
    'btn',
    'btn-main' => !isset($destino->id),
    'btn-success' => isset($destino->id),
]) data-bs-toggle="modal"
    data-bs-target="#modalCriarDestino{{ $destino->id ?? Auth::user()->id }}">
    @if (isset($destino))
        <i class="bi bi-pencil-square"></i>
    @else
        <i class="bi bi-plus"></i>
        <span>Destino</span>
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="modalCriarDestino{{ $destino->id ?? Auth::user()->id }}" tabindex="-1"
    aria-labelledby="modalCriarDestino{{ $destino->id ?? Auth::user()->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5">
                    @if (isset($destino))
                        <i class="bi bi-pencil-square"></i>
                        <span>Destino</span>
                    @else
                        <i class="bi bi-plus"></i>
                        <span>Destino</span>
                    @endif
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ isset($destino) ? route('edit.destino') : route('create.destino') }}">
                    @csrf

                    @if (isset($destino))
                        @method('PUT')
                        <legend>Editar Destino</legend>

                        <input type="hidden" name="destino_id" value="{{ $destino->id }}">
                    @else
                        <i class="bi bi-plus"></i>
                        <legend>Novo Destino</legend>
                    @endif

                    <div class="mb-3">
                        <label for="destino_nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome" maxlength="50"
                            minlength="1" value="{{ $destino->nome ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="f" class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            @if (count($tipo_destino) > 0)
                                @foreach ($tipo_destino as $tipo)
                                    <option value="{{ $tipo }}" @selected(isset($destino) && $tipo == $destino->tipo)>{{ $tipo }}
                                    </option>
                                @endforeach
                            @else
                                <option>
                                    Nenhuma Destinação registrada
                                </option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="destino_descricao" class="form-label">Descrição</label>
                        <textarea id="destino_descricao" class="form-control" name="descricao" cols="30" rows="3" minlength="10"
                            maxlength="500">{{ $destino->descricao ?? '' }}</textarea>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="d-flex justify-content-end">
                        @if (isset($destino))
                            <button class="btn btn-success">Enviar</button>
                        @else
                            <button class="btn btn-primary">Enviar</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
