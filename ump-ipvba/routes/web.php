<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Cronogramas;
use App\Http\Controllers\Membros;
use App\Http\Controllers\Caixas;
use App\Http\Controllers\Comprovantes;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\Pedidos;
use App\Http\Controllers\Prod_peds;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Cronogramas::class, 'inicial'])->name('inicial');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('cronograma')->group(function () {
        Route::get('/', [Cronogramas::class, 'cronograma'])->name('cronograma');
        Route::post('/', [Cronogramas::class, 'store'])->name('cronograma-store');
        Route::get('/editar/{id}', [Cronogramas::class, 'edit'])->name('cronograma-edit');
        Route::put('/editar/{id}', [Cronogramas::class, 'update'])->name('cronograma-update');
        Route::delete('/{id}', [Cronogramas::class, 'destroy'])->name('cronograma-destroy');
    });
    
    Route::prefix('membros')->group(function () {
        Route::get('/', [Membros::class, 'membros'])->name('membros');
        Route::post('/', [Membros::class, 'store'])->name('membros-store');
        Route::get('/editar/{id}', [Membros::class, 'edit'])->name('membros-edit');
        Route::put('/editar/{id}', [Membros::class, 'update'])->name('membros-update');
        Route::delete('/{id}', [Membros::class, 'destroy'])->name('membros-destroy');
    
        Route::get('/export', [Membros::class, 'export'])->name('membros-export');
    });
    
    Route::prefix('caixa')->group(function () {
        Route::get('/', [Caixas::class, 'caixa'])->name('caixa');
        Route::post('/', [Caixas::class, 'store'])->name('caixa-store');
        Route::get('/editar/{id}', [Caixas::class, 'edit'])->name('caixa-edit');
        Route::put('/editar/{id}', [Caixas::class, 'update'])->name('caixa-update');
        Route::delete('/{id}', [Caixas::class, 'destroy'])->name('caixa-destroy');
    
        Route::get('/{id}/{path}', [Caixas::class, 'download'])->name('comp-down');
        Route::delete('/editar/{comp}/{id}', [Caixas::class, 'destroy_comp'])->name('comp-destroy');
    
        Route::get('/export', [Caixas::class, 'export'])->name('caixa-export');
    });
    
    
    Route::prefix('produtos')->group(function () {
        Route::get('/', [Produtos::class, 'produto'])->name('produto');
        Route::post('/', [Produtos::class, 'store'])->name('produto-store');
        Route::get('/editar/{id}', [Produtos::class, 'edit'])->name('produto-edit');
        Route::put('/editar/{id}', [Produtos::class, 'update'])->name('produto-update');
        Route::delete('/{id}', [Produtos::class, 'destroy'])->name('produto-destroy');
    });
    
    Route::prefix('pedidos')->group(function () {
        Route::get('/', [Pedidos::class, 'pedido'])->name('pedido');
        Route::post('/', [Pedidos::class, 'store'])->name('pedido-store');
        Route::get('/{id}/final', [Pedidos::class, 'edit'])->name('pedido-edit');
        Route::put('/{id}/final', [Pedidos::class, 'update'])->name('pedido-update');
        Route::delete('/{id}', [Pedidos::class, 'destroy'])->name('pedido-destroy');    
    
        Route::prefix('{id}/prod')->group(function () {
            Route::get('/', [Prod_peds::class, 'prod_ped'])->name('prod');
            Route::post('/', [Prod_peds::class, 'store'])->name('prod-store');
            Route::delete('/{p}', [Prod_peds::class, 'destroy'])->name('prod-destroy');    
        });   
        
        Route::get('/cozinha', [Pedidos::class, 'cozinha'])->name('cozinha');
        Route::get('/cozinha/editar/{id}', [Pedidos::class, 'coz_edit'])->name('cozinha-edit');
        Route::put('/cozinha/{id}', [Pedidos::class, 'coz_up'])->name('cozinha-update');
    
    });
    
});

require __DIR__.'/auth.php';

Route::get('/cronograma/view/{id}', [Cronogramas::class, 'view'])->name('view');

Route::get('/game', [Membros::class, 'guGame'])->name('gu-game');


