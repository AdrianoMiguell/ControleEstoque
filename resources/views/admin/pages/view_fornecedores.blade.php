<?php
$colunasFornec = config('database.fornecedores');
?>

<section id="section_fornecedores" class="container container-view @if ($sectionAtiva === 'section_fornecedores') show @endif">
    <div id="table-fornecedor" class="div-content-table">
        <div class="d-flex flex-column gap-4 my-3">
            <div class="d-flex justify-content-between align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a class="tabs-link actived">
                        <h2 class="text">Fornecedores</h2>
                    </a>
                </div>
                <div>
                    <button class="btn btn-success dropdown-toggle" type="button" id="exportButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-share-fill"></i> Exportar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportButton">
                        <li><a class="dropdown-item" href="{{ route('export.fornecedores') }}">Exportar Todos</a></li>
                        @if (count($fornecedores) > 0)
                            <li><a class="dropdown-item"
                                    href="{{ route('export.fornecedores', ['filtered' => 'true', 'search' => request('search')]) }}">Exportar
                                    Filtrados</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="d-flex justify-content-between gap-2">
                @include('admin.create_edit.modal-create-edit-fornecedor')
                <form action="{{ route('dashboard.admin') }}" method="GET"
                    class="d-flex gap-2 align-items-center justify-content-end">

                    <!-- Campo de busca -->
                    <div class="d-flex border-0 rounded-5" role="search">
                        <input class="form-control border-0 rounded-5" type="search" name="search"
                            placeholder="Pesquisar Fornecedor..." value="{{ request('search') }}">
                        <button class="btn btn-transparent rounded-5 rounded-end" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- Filtros de ordenação -->
                    <div class="d-flex gap-1">
                        <select class="form-select" name="orderByFornec">
                            @foreach ($colunasFornec['colunas'] as $key => $column)
                                <option value="{{ $column }}" class="text-capitalize"
                                    {{ request('orderByFornec') == $column ? 'selected' : '' }}>
                                    {{ $colunasFornec['nomes'][$key] }}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-select" name="tipoOrderByFornec">
                            <option value="asc" {{ request('tipoOrderByFornec') == 'asc' ? 'selected' : '' }}>ASC
                            </option>
                            <option value="desc" {{ request('tipoOrderByFornec') == 'desc' ? 'selected' : '' }}>
                                DESC
                            </option>
                        </select>
                    </div>

                    <!-- Campo oculto para manter a seção ativa -->
                    <input type="hidden" name="section" value="section_fornecedores">
                </form>
            </div>
        </div>

        <div class="container-table">
            @if (count($fornecedores) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="min-width: 150px;">Nome</th>
                            <th scope="col">Identificação</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">CEP</th>
                            <th scope="col" style="min-width: 100px;">Estado</th>
                            <th scope="col" style="min-width: 100px;">Cidade</th>
                            <th scope="col" style="min-width: 150px;">Especificações</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{ $fornecedor->nome ?? '' }}</td>
                                <td>{{ $fornecedor->identificacao ?? '' }}</td>
                                <td>{{ $fornecedor->telefone ?? '' }}</td>
                                <td>{{ $fornecedor->email ?? '' }}</td>
                                <td>{{ $fornecedor->cep ?? '' }}</td>
                                <td>{{ $fornecedor->estado ?? '' }}</td>
                                <td>{{ $fornecedor->cidade ?? '' }}</td>
                                <td>
                                    <a href="http://maps.google.com.br/maps?q={{ $fornecedor->estado . ' ' . $fornecedor->cidade . ' ' . $fornecedor->bairro . ' ' . $fornecedor->rua . ' ' . $fornecedor->numero }}"
                                        target="_blank" class="text-decoration-none">
                                        <i class="bi bi-geo-alt-fill"></i> &nbsp;
                                        {{ $fornecedor->bairro . ', ' . $fornecedor->rua . ', N° ' . $fornecedor->numero ?? '' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @include('admin.create_edit.modal-create-edit-fornecedor')
                                        @include('admin.delete.modal-delete-fornecedor')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center p-2 m-3">
                    @if (request('search'))
                        Nenhum fornecedor encontrado.
                    @else
                        Nenhum fornecedor registrado.
                    @endif
                </p>
            @endif
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4 mb-2">
            {{ $fornecedores->appends(['section' => 'section_fornecedores'])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
