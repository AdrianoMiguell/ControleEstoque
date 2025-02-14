<section id="section_destinos" class="container container-view @if ($sectionAtiva === 'section_destinos') show @endif">
    <div id="table-destinos" class="div-content-table">
        <div class="d-flex flex-column gap-4 my-3">
            <div class="d-flex justify-content-between align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a class="tabs-link actived">
                        <h2 class="text">Destinos</h2>
                    </a>
                </div>
                <div>
                    <button class="btn btn-success dropdown-toggle" type="button" id="exportButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-share-fill"></i> Exportar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportButton">
                        <li><a class="dropdown-item" href="{{ route('export.destinos') }}">Exportar Todos</a></li>
                        @if (count($destinos) > 0)
                            <li><a class="dropdown-item"
                                    href="{{ route('export.destinos', ['filtered' => 'true', 'search' => request('search')]) }}">Exportar
                                    Filtrados</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="d-flex justify-content-between gap-2">
                @include('admin.create_edit.modal-create-edit-destino')

                <form action="{{ route('dashboard.admin') }}" method="GET"
                    class="d-flex gap-2 align-items-center justify-content-end">

                    <!-- Campo de busca -->
                    <div class="d-flex border-0 rounded-5" role="search">
                        <input class="form-control border-0 rounded-5" type="search" name="search"
                            placeholder="Pesquisar Destino..." value="{{ request('search') }}">
                        <button class="btn btn-transparent rounded-5 rounded-end" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- Filtros de ordenação -->
                    <div class="d-flex gap-1">
                        <select class="form-select" name="orderByDestinos">
                            <option value="nome" {{ request('orderByDestinos') == 'nome' ? 'selected' : '' }}>Nome
                            </option>
                            <option value="tipo" {{ request('orderByDestinos') == 'tipo' ? 'selected' : '' }}>Tipo
                            </option>
                            <option value="descricao" {{ request('orderByDestinos') == 'descricao' ? 'selected' : '' }}>
                                Descrição</option>
                        </select>
                        <select class="form-select" name="tipoOrderByDestinos">
                            <option value="asc" {{ request('tipoOrderByDestinos') == 'asc' ? 'selected' : '' }}>
                                ASC
                            </option>
                            <option value="desc" {{ request('tipoOrderByDestinos') == 'desc' ? 'selected' : '' }}>
                                DESC
                            </option>
                        </select>
                    </div>

                    <!-- Campo oculto para manter a seção ativa -->
                    <input type="hidden" name="section" value="section_destinos">
                </form>
            </div>
        </div>

        <div class="container-table">
            @if (count($destinos) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($destinos as $destino)
                            <tr>
                                <td>{{ $destino->nome ?? '' }}</td>
                                <td>{{ $destino->tipo ?? '' }}</td>
                                <td>{{ $destino->descricao ?? '' }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @include('admin.create_edit.modal-create-edit-destino')
                                        @include('admin.delete.modal-delete-destino')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center p-2 m-3">
                    @if (request('search'))
                        Nenhum destino encontrada.
                    @else
                        Nenhum destino registrada.
                    @endif
                </p>
            @endif
        </div>

        <!-- Paginação -->
        <div class="mt-4 mb-2 d-flex justify-content-center">
            {{ $destinos->appends(['section' => 'section_destinos'])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
