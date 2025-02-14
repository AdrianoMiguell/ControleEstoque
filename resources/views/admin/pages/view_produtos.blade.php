<section id="section_produtos" class="container container-view @if ($sectionAtiva === 'section_produtos') show @endif">
    <div id="table-produtos" class="div-content-table">
        <div class="d-flex flex-column gap-4 my-3">
            <div class="d-flex justify-content-between align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a class="tabs-link actived">
                        <h2 class="text">Produtos</h2>
                    </a>
                </div>
                <div>
                    <button class="btn btn-success dropdown-toggle" type="button" id="exportButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-share-fill"></i> Exportar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportButton">
                        <li><a class="dropdown-item" href="{{ route('export.produtos') }}">Exportar Todos</a></li>
                        @if (count($produtos) > 0)
                            <li><a class="dropdown-item"
                                    href="{{ route('export.produtos', ['filtered' => 'true', 'search' => request('search')]) }}">Exportar
                                    Filtrados</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2">
                @include('admin.create_edit.modal-create-edit-produto')

                <form action="{{ route('dashboard.admin') }}" method="GET"
                    class="d-flex gap-2 align-items-center justify-content-end">

                    <!-- Campo de busca -->
                    <div class="d-flex border-0 rounded-5" role="search">
                        <input class="form-control border-0 rounded-5" type="search" name="search"
                            placeholder="Pesquisar produto ..." value="{{ request('search') }}">
                        <button class="btn btn-transparent rounded-5 rounded-end" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- Filtros de ordenação -->
                    <div class="d-flex gap-1">
                        <select class="form-select" name="orderByProdutos">
                            <option value="nome" {{ request('orderByProdutos') == 'nome' ? 'selected' : '' }}>Nome
                            </option>
                            <option value="preco" {{ request('orderByProdutos') == 'preco' ? 'selected' : '' }}>
                                Preço
                            </option>
                            <option value="estoque" {{ request('orderByProdutos') == 'estoque' ? 'selected' : '' }}>
                                Quantidade
                            </option>
                        </select>
                        <select class="form-select" name="tipoOrderByProdutos">
                            <option value="asc" {{ request('tipoOrderByProdutos') == 'asc' ? 'selected' : '' }}>
                                ASC
                            </option>
                            <option value="desc" {{ request('tipoOrderByProdutos') == 'desc' ? 'selected' : '' }}>
                                DESC
                            </option>
                        </select>
                    </div>

                    <!-- Campo oculto para manter a seção ativa -->
                    <input type="hidden" name="section" value="section_produtos">
                </form>
            </div>
        </div>

        <div class="container-table">
            @if (count($produtos) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Estoque (Unidade)</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome ?? '' }}</td>
                                <td>{{ $produto->descricao ?? '' }}</td>
                                <td> R$&nbsp;{{ str_replace('.', ',', $produto->preco) ?? '0' }}</td>
                                <td>{{ $produto->estoque ?? '0' }}</td>
                                <td>{{ $produto->unidadeEstoque->descricao ?? 'Não definido' }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @include('admin.create_edit.modal-create-edit-produto')
                                        @include('admin.delete.modal-delete-produto')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center p-2 m-3">
                    @if (request('search'))
                        Nenhum produto encontrado.
                    @else
                        Nenhum produto registrado.
                    @endif
                </p>
            @endif
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4 mb-2">
            {{ $produtos->appends(['section' => 'section_produtos'])->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div id="table-unidests" class="div-content-table">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 my-4">
            <div class="d-flex align-items-center gap-2">
                <span class="tabs-link actived">
                    <h2 class="text">Unidades de Medida</h2>
                </span>
            </div>
            <div class="d-flex gap-2 align-items-center">
                @include('admin.create_edit.modal-create-edit-unidest')

                <div>
                    @if (count($unidades_estoque) > 0)
                        <a class="btn btn-success"
                            href="{{ route('export.unidades', ['filtered' => 'true', 'search' => request('search')]) }}">
                            <i class="bi bi-share-fill"></i>
                            Exportar&nbsp;Filtrados</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="container-table">
            @if (count($unidades_estoque) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Descrição</th>
                            <th scope="col">Sigla</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidades_estoque as $unid)
                            @if (isset($unid))
                                <tr>
                                    <td>{{ $unid->descricao ?? '' }}</td>
                                    <td>{{ $unid->sigla ?? '' }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @include('admin.create_edit.modal-create-edit-unidest')
                                            @include('admin.delete.modal-delete-unidest')
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center p-2 m-3">
                    @if (request('search'))
                        Nenhuma unidade encontrada.
                    @else
                        Nenhuma unidade registrada.
                    @endif
                </p>
            @endif
        </div>
    </div>
</section>
