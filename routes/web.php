<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\HomeController::class, 'calculo_frete'])->name('calcular');
    Route::get('/frete', [App\Http\Controllers\HomeController::class, 'frete'])->name('frete');
    Route::get('/volumes', [App\Http\Controllers\HomeController::class, 'volumes'])->name('volumes');
    Route::get('/financeiro', [App\Http\Controllers\HomeController::class, 'financeiro'])->name('financeiro');
});


Route::group(['prefix'=>'banco_precos','as'=>'bancodedados.'], function(){
    Route::get('/', [App\Http\Controllers\BancoDeDadosController::class, 'index'])->name('listar');
    Route::get('/listar-tabelas-de-precos', [App\Http\Controllers\BancoDeDadosController::class, 'show'])->name('api');
    
    //EXCEL
    Route::post('/import-table', [App\Http\Controllers\BancoDeDadosController::class, 'import'])->name('import-table');
    Route::get('/export-table', [App\Http\Controllers\BancoDeDadosController::class, 'exportTable'])->name('export-table');
    Route::post('/remove-table', [App\Http\Controllers\BancoDeDadosController::class, 'removeTable'])->name('remove-table');
});

Route::group(['prefix'=>'cotacoes', 'as'=>'cotacoes.'], function() {
    Route::get('/', [App\Http\Controllers\CotacaoController::class, 'index'])->name('index');
    Route::get('/listar-cotacoes', [App\Http\Controllers\CotacaoController::class, 'api'])->name('api');

    Route::get('/create', [App\Http\Controllers\CotacaoController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\CotacaoController::class, 'store'])->name('store');
    Route::get('/show/{id}', [App\Http\Controllers\CotacaoController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [App\Http\Controllers\CotacaoController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [App\Http\Controllers\CotacaoController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [App\Http\Controllers\CotacaoController::class, 'destroy'])->name('destroy');

    //EXCEL
    Route::get('/export-table', [App\Http\Controllers\CotacaoController::class, 'exportTable'])->name('export-table');
});