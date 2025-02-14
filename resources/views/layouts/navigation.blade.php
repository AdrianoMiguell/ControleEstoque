<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard.admin', ['section' => 'section_produtos']) }}">AGRO Estoques</a>

        @if (isset(Auth::user()->id))
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="bi bi-list toggler-icon"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_produtos' ? 'fw-bolder' : '' }} nav-link nav-container"
                            data-in-target="#section_produtos"
                            href="{{ route('dashboard.admin', ['section' => 'section_produtos']) }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_fornecedores' ? 'fw-bolder' : '' }} nav-link nav-container"
                            data-in-target="#section_fornecedores"
                            href="{{ route('dashboard.admin', ['section' => 'section_fornecedores']) }}">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_destinos' ? 'fw-bolder' : '' }} nav-link nav-container"
                            data-in-target="#section_destinos"
                            href="{{ route('dashboard.admin', ['section' => 'section_destinos']) }}">Destinos</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_movimentacoes' ? 'fw-bolder' : '' }} nav-link nav-container"
                            data-in-target="#section_movimentacoes"
                            href="{{ route('dashboard.admin', ['section' => 'section_movimentacoes']) }}">Movimentações</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-profile" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi-person-circle fs-1"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}"
                                    onsubmit="return confirm('Tem certeza que deseja sair da conta atual?')">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-inline">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        @else
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-expanded="false">
                <i class="bi bi-list toggler-icon"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            Entrar
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">
                                Registrar-se
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        @endif
    </div>

</nav>

@if (isset(Auth::user()->id))
    <style>
        .offcanvas {
            background-color: #efeffe;
            --bs-offcanvas-width: 300px !important;
        }

        .offcanvas .nav-container {
            border: none !important;
        }

        .offcanvas .nav-container:hover,
        .offcanvas .nav-container:active,
        .offcanvas .nav-container:focus,
        .offcanvas .nav-container:focus-visible {
            background-color: #daeaec !important;
        }
    </style>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title d-flex align-items-center gap-2" id="offcanvasExampleLabel">
                <i class="bi bi-person-circle"></i>&nbsp;{{ Auth::user()->name }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="mb-4 p-1 d-flex flex-column gap-4 flex-grow-1">
                <div>
                    <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_produtos' ? 'fw-bolder' : '' }} w-100 btn text-bold nav-container"
                        data-in-target="#section_produtos"
                        href="{{ route('dashboard.admin', ['section' => 'section_produtos']) }}">Produtos</a>
                </div>
                <div>
                    <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_fornecedores' ? 'fw-bolder' : '' }} w-100 btn text-bold nav-container"
                        data-in-target="#section_fornecedores"
                        href="{{ route('dashboard.admin', ['section' => 'section_fornecedores']) }}">Fornecedores</a>
                </div>
                <div>
                    <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_destinos' ? 'fw-bolder' : '' }} w-100 btn text-bold nav-container"
                        data-in-target="#section_destinos"
                        href="{{ route('dashboard.admin', ['section' => 'section_destinos']) }}">Destinos</a>
                </div>
                <div>
                    <a class="{{ isset($sectionAtiva) && $sectionAtiva == 'section_movimentacoes' ? 'fw-bolder' : '' }} w-100 btn text-bold nav-container"
                        data-in-target="#section_movimentacoes"
                        href="{{ route('dashboard.admin', ['section' => 'section_movimentacoes']) }}">Movimentações</a>
                </div>
            </div>

            <!-- Esse div será jogado para o final -->
            <div class="mt-auto">
                <a class="w-100 btn btn-transparent text-bold nav-container" href="{{ route('profile.edit') }}">
                    <i class="bi bi-gear-fill"></i>&nbsp;Minha Conta
                </a>
                <form method="POST" action="{{ route('logout') }}"
                    onsubmit="return confirm('Tem certeza que deseja sair da conta atual?')">
                    @csrf

                    <button type="submit" class="w-100 btn btn-transparent text-bold nav-container">
                        Sair
                    </button>
                </form>

            </div>
        </div>
    </div>
@endif
