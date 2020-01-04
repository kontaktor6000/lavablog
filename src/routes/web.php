<?php


use App\Http\Controllers\PerfumeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/perfume', [PerfumeController::class, 'indexAction']);
Route::get('/add_perfume', [PerfumeController::class, 'createPerfumeAction']);

Route::post('/add_perfume', [PerfumeController::class, 'addPerfumeAction']);
