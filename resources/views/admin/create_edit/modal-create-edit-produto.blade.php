<!-- Button trigger modal -->
<button type="button" @class([
    'btn',
    'btn-main' => !isset($produto->id),
    'btn-success' => isset($produto->id),
]) data-bs-toggle="modal"
    data-bs-target="#modalCriarProduto{{ $produto->id ?? Auth::user()->id }}">
    @if (isset($produto))
        <i class="bi bi-pencil-square"></i>
    @else
        <i class="bi bi-plus"></i>
        <span>Produto</span>
    @endif
</button>

<!-- Modal -->
<div class="modal fade" id="modalCriarProduto{{ $produto->id ?? Auth::user()->id }}" tabindex="-1"
    aria-labelledby="modalCriarProduto{{ $produto->id ?? Auth::user()->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5">
                    @if (isset($produto))
                        <i class="bi bi-pencil-square"></i>
                        <span>Produto</span>
                    @else
                        <i class="bi bi-plus"></i>
                        <span>Produto</span>
                    @endif
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ isset($produto) ? route('edit.produto') : route('create.produto') }}">
                    @csrf

                    @if (isset($produto))
                        @method('PUT')
                        <legend>Editar Produto</legend>

                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                    @else
                        <legend>Novo Produto</legend>
                    @endif

                    <div class="mb-3">
                        <label for="produto_nome" class="form-label">Nome</label>
                        <input id="produto_nome" type="text" class="form-control" name="nome" placeholder="nome"
                            value="{{ $produto->nome ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="produto_descricao" class="form-label">Descrição</label>
                        <textarea id="produto_descricao" class="form-control" name="descricao" cols="30" rows="3" minlength="10">{{ $produto->descricao ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="produto_preco" class="form-label">Preço</label>
                        <input id="produto_preco" type="number" class="form-control" name="preco" placeholder="Preço"
                            step=".01" min="0" max="10000000000" value="{{ $produto->preco ?? 0 }}">
                    </div>
                    <div class="mb-3">
                        <label for="produto_estoque" class="form-label">Estoque</label>
                        <input id="produto_estoque" type="number" class="form-control" name="estoque"
                            placeholder="Estoque" min="0" max="10000000000" value="0"
                            value="{{ $produto->estoque ?? 0 }}">
                    </div>

                    <div class="mb-3">
                        <label for="produto_unidest" class="form-label">Unidade de Estoque</label>
                        <select id="produto_unidest" name="unidade_estoque_id" class="form-select">
                            @if (count($unidades_estoque) > 0)
                                @foreach ($unidades_estoque as $unid)
                                    <option value="{{ $unid->id }}" @selected(isset($produto) && $unid->id == $produto->unidade_estoque_id)>
                                        {{ $unid->descricao }} ({{ $unid->sigla }})
                                    </option>
                                @endforeach
                            @else
                                <option>
                                    Nenhuma Unidade de Estoque registrada
                                </option>
                            @endif
                        </select>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="d-flex justify-content-end">
                        @if (isset($produto))
                            <button class="btn btn-success">
                                <span>Editar</span>
                            </button>
                        @else
                            <button class="btn btn-primary">
                                <span>Enviar</span>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
