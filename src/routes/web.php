<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('check.age');



Route::prefix('admin')->middleware('check.age')->group(function() {
    Route::get('/test', function () {
        echo 'asdfasdf';
    });
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


