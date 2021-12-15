<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use App\Http\Controllers\EpisodiosController;

// Route::get('/series', 'SeriesController@listarSeries');
Route::get('/series', [SeriesController::class, 'index'])->name('listar_series');
Route::get('/series/criar', [SeriesController::class, 'create'])->name('form_criar_serie');
Route::post('/series/criar', [SeriesController::class, 'store']);
Route::delete('/series/{id}', [SeriesController::class, 'destroy']);
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editName']);
Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);

// o index desse controller precisa que o parâmetro dessa rota se chame "temporada"
Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);
