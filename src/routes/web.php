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
});

Route::get('/list_students', "StudentsController@index")->name('list_students');

Route::get('/add_students', "StudentsController@add")->name('add_students');
Route::post('/add_students', "StudentsController@store")->name('store_students');


Route::get('/create_absent/{id}','AbsentsController@create')->name('create_absent');
Route::post('/add_absent','AbsentsController@addAbsent')->name('add_absent');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
