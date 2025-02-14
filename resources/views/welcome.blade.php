<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AGRO Estoque</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Contrail+One&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="/build/css/geral.css">
    <link rel="stylesheet" href="/build/css/navbar.css">
    <link rel="stylesheet" href="/build/css/button.css">
</head>

<body class="bg-light vh-100">

    @include('layouts.navigation')

    <main class="d-flex align-items-center justify-content-center p-5">
        <div class="container text-center p-5 bg-white shadow rounded-4">
            <img src="/build/assets/agro_sistem.svg" alt="Ilustração Agro" class="img-fluid mb-4"
                style="max-width: 500px;">

            <h1 class="fw-bold text-success">Bem-vindo ao AGRO Estoque</h1>
            <p class="text-muted">
                Gerencie o estoque da sua indústria agropecuária com facilidade e precisão.
            </p>

            <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg px-4 mt-3">
                Começar Agora
            </a>

            <p class="mt-4 text-secondary small">
                <a href="https://www.freepik.com/free-vector/happy-female-farmer-working-farm-feed-population-flat-vector-illustration-cartoon-farm-with-automation-technology_10172819.htm"
                    target="_blank" class="text-decoration-none">
                    Ilustração por pch.vector no Freepik
                </a>
            </p>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
