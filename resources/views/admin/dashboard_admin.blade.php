@extends('layouts.app')

@section('links_css')
    <!-- Adicione o CSS do Select2 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="/build/css/table.css">
@endsection

{{-- 
    Ideias:
    ✅ Relatório de Movimentação: Histórico completo de entradas e saídas.
    ✅ Itens mais movimentados: Produtos com maior volume de entradas e saídas.
    ✅ Saídas no mês: Quantidade total e valor arrecadado por período.
    ✅ Estoque Atual: Listagem do que está disponível.
    ✅ Média de Preço de Compra: Base para definir o valor de saída.
    ✅ Alertas de Estoque Baixo: Produtos abaixo do nível mínimo.
    ✅ Relatório Financeiro: Total investido e arrecadado em um período.
 --}}

{{-- @section('options')
    <style>
        .options-header {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0;
            margin-top: 0;
            margin-bottom: 3rem;
            padding: 0;
        }

        .options-header>.btn-main {
            flex: 1;
            padding: 1rem;
        }
    </style>
@endsection --}}

@section('content')
    <style>
        .container-view.show {
            display: grid !important;
        }

        .container-view {
            display: none;
            gap: 2rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .container-view .tabs-link {
            text-decoration: none;
            text-transform: capitalize;
            border-bottom: 2.5px solid transparent;
        }

        .container-view .tabs-link .text {
            margin-bottom: 0;
            font-weight: 550;
            font-size: 20pt;
        }

        .container-view .bi {
            margin-bottom: 2.5px;
        }

        .container-view .tabs-link:not(.actived) {
            color: #011328;
            opacity: 0.95;
        }

        .container-view .tabs-link.actived {
            color: #011328;
            opacity: 1;
            border-color: transparent;
        }

        .container-view .tabs-link:not(.actived):hover,
        .container-view .tabs-link:not(.actived):active,
        .container-view .tabs-link:not(.actived):focus,
        .container-view .tabs-link:not(.actived):focus-visible {
            opacity: 1;
            color: #011328;
            border-color: #011328;
        }

        .container-view div[role="search"] {
            background-color: #efeffe;
        }

        .container-view div[role="search"] .form-control[name="search"] {
            box-shadow: none !important;
            background-color: #efeffe;
            border-end-end-radius: 0 !important;
            border-start-end-radius: 0 !important;
        }

    </style>

    @if ($sectionAtiva === 'section_produtos')
        @include('admin.pages.view_produtos')
    @endif

    @if ($sectionAtiva === 'section_fornecedores')
        @include('admin.pages.view_fornecedores')
    @endif

    @if ($sectionAtiva === 'section_destinos')
        @include('admin.pages.view_destinos')
    @endif

    @if ($sectionAtiva === 'section_movimentacoes')
        @include('admin.pages.view_movimentacoes')
    @endif
@endsection


@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="/build/js/select2.js"></script> --}}
    <!-- Adicionar no <head> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection
