<!-- Button trigger modal -->
<button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#modalCriarEntrada">
    <i class="bi bi-plus"></i>&nbsp;Entrada
</button>

<!-- Modal -->
<div class="modal fade" id="modalCriarEntrada" tabindex="-1" aria-labelledby="modalCriarEntradaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5">
                    <i class="bi bi-plus"></i>
                    <span>Entrada</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('create.entrada') }}">
                    @csrf

                    <legend>Novo Entrada</legend>

                    {{-- <div class="mb-3">
                        <label for="entrada_fornecedor" class="form-label">Fornecedor</label>
                        <select name="fornecedor_id" class="form-select" id="entrada_fornecedor">
                            @foreach ($all_fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="entrada_produto" class="form-label">Produto</label>
                        <select name="produto_id" class="form-select" id="entrada_produto">
                            @foreach ($all_produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }} </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="mb-3">
                        <label for="entrada_fornecedor" class="form-label">Fornecedor</label>
                        <select name="fornecedor_id" class="form-select select2" id="entrada_fornecedor">
                            <option value="">Selecione um fornecedor...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="entrada_produto" class="form-label">Produto</label>
                        <select name="produto_id" class="form-select select2" id="entrada_produto">
                            <option value="">Selecione um produto...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="entrada_quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="entrada_quantidade" name="quantidade" max="100000000"
                            min="1" />
                    </div>

                    <input type="hidden" name="tipo" value="1">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modalCriarEntrada').on('shown.bs.modal', function() {
            function initSelect2(selector, url) {
                $(selector).select2({
                    dropdownParent: $("#modalCriarEntrada"), // Corrige o problema do z-index
                    placeholder: 'Digite para buscar...',
                    allowClear: true,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250, // Evita muitas requisições rápidas
                        data: function(params) {
                            return {
                                search: params.term
                            }; // Passa o termo de pesquisa
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(item => ({
                                    id: item.id,
                                    text: item.nome
                                }))
                            };
                        },
                        cache: true
                    }
                });
            }

            initSelect2("#entrada_fornecedor", "{{ route('api.fornecedores') }}");
            initSelect2("#entrada_produto", "{{ route('api.produtos') }}");
        });
    });
</script>
