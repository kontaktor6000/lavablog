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

Route::get('/countries_list', 'CountryController@index')->name('countries_list');
Route::get('/publishing_houses_list', 'PublishingHouseController@index')->name('publishing_houses_list');
Route::get('/cities_list', 'CityController@index')->name('cities_list');
Route::get('/owners_list', 'OwnerController@index')->name('owners_list');
Route::get('/authors_list', 'AuthorController@index')->name('authors_list');

Route::get('/books_list', 'BookController@index')->name('books_list');
Route::get('/add_book', 'BookController@create')->name('add_book');
Route::post('/add_book', 'BookController@store');

Route::get('/show_book/{id}', 'BookController@show')->name('show_book');
Route::get('/edit_book/{id}', 'BookController@edit')->name('edit_book');
Route::post('/update_book/{id}', 'BookController@update')->name('update_book');

Route::get('/delete_book/{id}', 'BookController@delete')->name('delete_book');

Route::get('/ratings_list', 'RatingController@index')->name('ratings_list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'BookController@search')->name('search');
Route::get('/search_with_selection', 'BookController@searchWithSelection')->name('search_with_selection');


Route::get('/scaner', 'ScanController@scan')->name('scaner_book');
Route::get('/parser', 'ParserController@parser')->name('parser_book');

Route::get('/whoisthis', 'WhoisthisController@whoIsThis')->name('whoisthis');




