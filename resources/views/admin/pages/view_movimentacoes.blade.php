<?php
$filter_movs = config('database.movimentacoes.filter_movs');
$nome_filter = ' Filtrar Movimentações';

if ($filter_request = request('filter')) {
    $posicao = array_search($filter_request, $filter_movs['opcao']);

    if ($posicao !== false) {
        // Usar a posição para obter o nome correspondente
        $nome_filter = $filter_movs['nome'][$posicao];
    }
}

?>

<section id="section_movimentacoes" class="container container-view @if ($sectionAtiva === 'section_movimentacoes') show @endif">
    <div id="table-entrada-saida" class="div-content-table">
        <div class="d-flex flex-column gap-4 my-3">
            <div class="d-flex justify-content-between align-items-center gap-2 my-4">
                <div class="d-flex align-items-center gap-2">
                    <a class="tabs-link actived">
                        <h2 class="text">Movimentações</h2>
                    </a>
                </div>
                <div>
                    <button class="btn btn-success dropdown-toggle" type="button" id="exportButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-share-fill"></i> Exportar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportButton">
                        <li><a class="dropdown-item" href="{{ route('export.movimentacoes') }}">Exportar Todos</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('export.movimentacoes', ['filtered' => 'true', 'filter' => request('filter')]) }}">Exportar
                                Filtrados</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-end gap-2 mb-2">
            <div class="dropdown">
                <button class="btn btn-main dropdown-toggle" type="button" id="filterDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-funnel"></i>
                    @if (request('filter'))
                        {{ $nome_filter }}
                    @else
                        Filtrar Movimentações
                    @endif
                </button>

                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    @if (request('filter'))
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('dashboard.admin', ['section' => 'section_movimentacoes']) }}">
                                <i class="bi bi-trash"></i>
                                Retirar Filtro </a>
                        </li>
                    @endif
                    @foreach ($filter_movs['opcao'] as $key => $opt)
                        @if ($opt !== request('filter'))
                            <li><a class="dropdown-item"
                                    href="{{ route('dashboard.admin', ['section' => 'section_movimentacoes', 'filter' => $opt]) }}">
                                    {{ $filter_movs['nome'][$key] }} </a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="d-flex justify-content-end gap-2 mb-2">
                @include('admin.create_edit.modal-create-edit-entrada')
                @include('admin.create_edit.modal-create-edit-saida')
            </div>
        </div>

        <div class="container-table">

            <style>
                #table-movimentacoes .tr-entrada td {
                    background-color: #d2f1e3;
                }

                #table-movimentacoes .tr-entrada td .bi {
                    color: rgb(0, 117, 61) !important;
                }

                #table-movimentacoes .tr-saida td {
                    background-color: #ffe6e1;
                }

                #table-movimentacoes .tr-saida td .bi {
                    color: rgb(156, 0, 0) !important;
                }

                .table .entrada {
                    color: rgb(0, 117, 61) !important;
                }

                .table .saida {
                    color: rgb(156, 0, 0) !important;
                }
            </style>

            @if (count($movimentacoes) > 0)
                <table class="table" id="table-movimentacoes">
                    <thead>
                        <tr>
                            <th scope="col">Tipo</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Fornecedor</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor Unitario</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Destino</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimentacoes as $movimentacao)
                            <tr @class([
                                'tr-saida' => $movimentacao->tipo == '0',
                                'tr-entrada' => $movimentacao->tipo == '1',
                            ])>
                                <td class="{{ $movimentacao->tipo == '0' ? 'saida' : 'entrada' }}"
                                    style="min-width: 100px;">
                                    <span class="d-flex gap-1">
                                        @if ($movimentacao->tipo == '0')
                                            <i class="bi bi-caret-down-fill"></i>
                                            <span>Saida</span>
                                        @else
                                            <i class="bi bi-caret-up-fill"></i>
                                            <span>Entrada</span>
                                        @endif
                                    </span>
                                </td>
                                <td style="min-width: 100px;">{{ $movimentacao->produto->nome ?? 'Não informado' }}
                                </td>
                                <td style="min-width: 150px;">{{ $movimentacao->fornecedor->nome ?? 'Não informado' }}
                                </td>
                                <td>{{ $movimentacao->quantidade ?? 'Não informado' }}</td>
                                <td>
                                    <span class="d-flex gap-1">
                                        @if (isset($movimentacao->valor_unitario))
                                            @if ($movimentacao->tipo == '0')
                                                <i class="bi bi-caret-down-fill"></i>
                                            @else
                                                <i class="bi bi-caret-up-fill"></i>
                                            @endif
                                            R$&nbsp;{{ str_replace('.', ',', $movimentacao->valor_unitario) ?? '' }}
                                        @else
                                            Não informado
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="d-flex gap-1">
                                        @if (isset($movimentacao->valor_total))
                                            @if ($movimentacao->tipo == '0')
                                                <i class="bi bi-caret-down-fill"></i>
                                            @else
                                                <i class="bi bi-caret-up-fill"></i>
                                            @endif
                                            R$&nbsp;{{ str_replace('.', ',', $movimentacao->valor_total) ?? '' }}
                                        @else
                                            Não informado
                                        @endif
                                    </span>
                                </td>
                                <td style="min-width: 150px;">{{ $movimentacao->destino->nome ?? 'Não informado' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center p-2 m-3">
                    @if (request('search'))
                        Nenhuma movimentação encontrada.
                    @else
                        Nenhuma movimentação registrada.
                    @endif
                </p>
            @endif
        </div>

        @if (count($movimentacoes) > 0)
            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-4 mb-2">
                {{ $movimentacoes->appends(['section' => 'section_movimentacoes'])->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>
