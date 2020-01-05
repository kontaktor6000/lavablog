<?php


use App\Http\Controllers\PerfumeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/perfume', [PerfumeController::class, 'indexAction']);

Route::get('/add_perfume', 'PerfumeController@createPerfumeAction')->name('create_perfume');
Route::post('/add_perfume', 'PerfumeController@addPerfumeAction')->name('add_perfume');
