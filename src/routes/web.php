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


//Route::prefix('admin')->/*middleware('check.age')->*/group(function() {
//    Route::get('/test', function () {
//        echo 'asdfasdf';
//    });

    //Route::get('/user', function() {
        //var_dump(\Illuminate\Support\Facades\Config::get('database.connections.mysql.host'));
       // \Illuminate\Support\Facades\Config::set(['database.connections.mysql.host' => 'mysql2']);
    //});

//});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add_post', 'PostController@show')->name('add_show')->middleware('check.user.server');
Route::post('/add_post', 'PostController@store')->name('add_post')->middleware('check.user.server');


