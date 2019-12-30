<?php


use App\Http\Controllers\ParfumeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/parfume', [ParfumeController::class, 'indexAction']);

Route::post('parfume', [ParfumeController::class, 'getDataAction']);
