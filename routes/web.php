<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SeriesController,
    TemporadasController,
    EpisodiosController,
    EntrarController,
    RegistroController
};

// Route::get('/series', 'SeriesController@listarSeries');
Route::get('/', function () { return redirect('/series'); });
Route::get('/series', [SeriesController::class, 'index'])->name('listar_series'); //->middleware('autenticador');
Route::get('/series/criar', [SeriesController::class, 'create'])->name('form_criar_serie')->middleware('autenticador');
Route::post('/series/criar', [SeriesController::class, 'store'])->middleware('autenticador');
Route::delete('/series/{id}', [SeriesController::class, 'destroy'])->middleware('autenticador');
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editName'])->middleware('autenticador');
Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);

// o index desse controller precisa que o parâmetro dessa rota se chame "temporada"
Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);
Route::post('/temporada/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->middleware('autenticador');

// Auth do Laravel
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth própria
Route::get('/entrar', [EntrarController::class, 'index']);
Route::post('/entrar', [EntrarController::class, 'entrar']);

Route::get('/registrar', [RegistroController::class, 'create']);
Route::post('/registrar', [RegistroController::class, 'store']);
Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});
