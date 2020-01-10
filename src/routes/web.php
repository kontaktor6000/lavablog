<?php



Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-client', 'ClientController@showAddForm')->name('add_client');
Route::post('/add-client', 'ClientController@store')->name('store_new_client');

