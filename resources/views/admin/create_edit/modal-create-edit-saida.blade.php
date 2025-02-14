<!-- Button trigger modal -->
<button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#modalCriarSaida">
    <i class="bi bi-plus"></i>&nbsp;Saida
</button>

<!-- Modal -->
<div class="modal fade" id="modalCriarSaida" tabindex="-1" aria-labelledby="modalCriarSaidaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5">
                    <i class="bi bi-plus"></i>
                    <span>Saida</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('create.saida') }}">
                    @csrf

                    <legend>Novo Saida</legend>

                    <div class="mb-3">
                        <label for="saida_destino" class="form-label">Destino</label>
                        <select name="destino_id" id="saida_destino" class="form-select select2">
                            <option value=""> Selecione um destino ... </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="saida_produto" class="form-label">Produto</label>
                        <select id="saida_produto" name="produto_id" class="form-select select2">
                            <option value=""> Selecione um produto ... </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="saida_quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="saida_quantidade" name="quantidade" max="100000000"
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
    $(document).ready(() => {
        $('#modalCriarSaida').on('shown.bs.modal', function() {
            function initSelect2(selector, url) {
                $(selector).select2({
                    dropdownParent: $('#modalCriarSaida'),
                    placeholder: 'Digite para buscar ...',
                    allowClear: true,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: (params) => {
                            return {
                                search: params.term
                            };
                        },
                        processResults: (data) => {
                            return {
                                results: data.map(item => ({
                                    id: item.id,
                                    text: item.descricao,
                                }))
                            }
                        },
                        cache: true,
                    }
                });
            }

            initSelect2("#saida_destino", "{{ route('api.destinos') }}");
            initSelect2("#saida_produto", "{{ route('api.produtos') }}");
        });
    });
</script>
