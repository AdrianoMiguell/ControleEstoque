<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DestinoController;
use App\Http\Controllers\Admin\FornecedorController;
use App\Http\Controllers\Admin\MovimentacaoController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\UnidadeEstoqueController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIfIsAdmin;
use App\Models\Destino;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Rota padrão do dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified', CheckIfIsAdmin::class])->name('dashboard');

    // Dashboard admin
    Route::get('/dashboard/admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    // Rotas de Unidades de Estoque
    Route::controller(UnidadeEstoqueController::class)->group(function () {
        Route::post('/dashboard/admin/unidest', 'create')->name('create.unidest');
        Route::put('/dashboard/admin/unidest', 'edit')->name('edit.unidest');
        Route::delete('/dashboard/admin/unidest{unid}', 'delete')->name('delete.unidest');
    });

    // Rotas de produtos
    Route::controller(ProdutoController::class)->group(function () {
        Route::get('/dashboard/admin/produto', 'index')->name('view.produto');
        Route::post('/dashboard/admin/produto', 'create')->name('create.produto');
        Route::put('/dashboard/admin/produto', 'edit')->name('edit.produto');
        Route::delete('/dashboard/admin/produto/{produto}', 'delete')->name('delete.produto');
    });

    // Rotas de fornecedores
    Route::controller(FornecedorController::class)->group(function () {
        Route::post('/dashboard/admin/fornecedor', 'create')->name('create.fornecedor');
        Route::put('/dashboard/admin/fornecedor', 'edit')->name('edit.fornecedor');
        Route::delete('/dashboard/admin/fornecedor/{fornecedor}', 'delete')->name('delete.fornecedor');
    });

    // Rotas de destino
    Route::controller(DestinoController::class)->group(function () {
        Route::post('/dashboard/admin/destino', 'create')->name('create.destino');
        Route::put('/dashboard/admin/destino', 'edit')->name('edit.destino');
        Route::delete('/dashboard/admin/destino{destino}', 'delete')->name('delete.destino');
    });

    // Rotas de movimentações
    Route::controller(MovimentacaoController::class)->group(function () {
        Route::post('/dashboard/admin/entrada', 'createEntrada')->name('create.entrada');
        Route::put('/dashboard/admin/entrada', 'editEntrada')->name('edit.entrada');
        Route::delete('/dashboard/admin/entrada', 'deleteEntrada')->name('delete.entrada');

        Route::post('/dashboard/admin/saida', 'createSaida')->name('create.saida');
        Route::put('/dashboard/admin/saida', 'editSaida')->name('edit.saida');
        Route::delete('/dashboard/admin/saida', 'deleteSaida')->name('delete.saida');
    });

    Route::controller(ExportController::class)->group(function () {
        Route::get('/exportar-produtos', 'exportProdutos')->name('export.produtos');

        Route::get('/exportar-unidades', 'exportUnidades')->name('export.unidades');

        Route::get('/exportar-fornecedores', 'exportFornecedores')->name('export.fornecedores');

        Route::get('/exportar-destinos', 'exportDestinos')->name('export.destinos');

        Route::get('/exportar-movimentacoes', 'exportMovimentacoes')->name('export.movimentacoes');
    });

    Route::get('/api/fornecedores', function (Request $request) {
        $search = $request->input('search');
        return Fornecedor::where('nome', 'like', "%{$search}%")
            ->orderBy('nome')
            ->take(10)
            ->get();
    })->name('api.fornecedores');

    Route::get('/api/produtos', function (Request $request) {
        $search = $request->input('search');
        return Produto::where('nome', 'like', "%{$search}%")
            ->orderBy('nome')
            ->take(10)
            ->get();
    })->name('api.produtos');

    Route::get('/api/destinos', function (Request $request) {
        $search = $request->input('search');
        return  Destino::where('descricao', 'LIKE', "%{$search}%")
            ->orderBy('descricao')
            ->take(10)
            ->get();
    })->name('api.destinos');

    // Route::get('/api/produtos', function (Request $request) {
    //     $search = $request->input('search');
    //     return Produto::where('nome', 'like', "%{$search}%")
    //         ->orderBy('nome')
    //         ->take(10)
    //         ->get();
    // })->name('api.produtos');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
