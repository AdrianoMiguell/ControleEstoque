<!-- Button trigger modal -->
<button type="button" @class([
    'btn',
    'btn-main' => !isset($unid->id),
    'btn-success' => isset($unid->id),
]) data-bs-toggle="modal"
    data-bs-target="#modalCriarUnidest{{ $unid->id ?? Auth::user()->id }}">
    @if (isset($unid))
        <i class="bi bi-pencil-square"></i>
    @else
        <i class="bi bi-plus"></i>
        <span>Estoque</span>
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="modalCriarUnidest{{ $unid->id ?? Auth::user()->id }}" tabindex="-1"
    aria-labelledby="modalCriarUnidest{{ $unid->id ?? Auth::user()->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5">
                    @if (isset($unid))
                        <i class="bi bi-pencil-square"></i>
                        <span>Unidade de Estoque</span>
                    @else
                        <i class="bi bi-plus"></i>
                        <span>Unidade de Estoque</span>
                    @endif

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ isset($unid) ? route('edit.unidest') : route('create.unidest') }}">
                    @csrf


                    @if (isset($unid))
                        @method('PUT')
                        <legend>Editar Unidade de Estoque</legend>

                        <input type="hidden" name="unidade_estoque_id" value="{{ $unid->id }}">
                    @else
                        <legend>Nova Unidade de Estoque</legend>
                    @endif

                    <div class="mb-3">
                        <label for="unidest_descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Descrição"
                            maxlength="40" minlength="1" value="{{ $unid->descricao ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="unidest_sigla" class="form-label">Sigla</label>
                        <input type="text" class="form-control" name="sigla" placeholder="Sigla" maxlength="40"
                            minlength="1" value="{{ $unid->sigla ?? '' }}">
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="d-flex justify-content-end">
                        @if (isset($unid))
                            <button class="btn btn-sucess">Editar</button>
                        @else
                            <button class="btn btn-primary">Enviar</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
