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

use App\Exports\StudentsExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list_students', "StudentsController@index")->name('list_students');
Route::get('/add_students', "StudentsController@add")->name('add_students');
Route::post('/add_students', "StudentsController@store")->name('store_students');
Route::get('/show_student/{id}', "StudentsController@show")->name('show_student');
Route::post('/show_student/{id}', "StudentsController@update")->name('update_student');
/*Route::get('/edit_student/{id}', "StudentsController@edit")->name('edit_student');
Route::post('/edit_student/{id}', "StudentsController@update")->name('update_student');*/
Route::get('/delete_student/{id}', 'StudentsController@delete')->name('delete_student');
Route::get('/list_students/{id}/active_student/', 'StudentsController@activate')->name('active_student');
Route::get('/list_students/{id}/not_active_student/', 'StudentsController@deactivate')->name('not_active_student');

Route::get('/download_students', 'StudentsController@export')->name('download_students');
Route::get('/filter_students', 'StudentsController@filter')->name('filter_students');

Route::get('/peachs_list', 'StudentsController@getPeaches')->name('peachs_list');
Route::get('/peach_delete/{id}', 'PeachsController@delete')->name('peach_delete');

Route::get('/events_list', 'EventsController@index')->name('events_list');
Route::get('/event_add', 'EventsController@add')->name('event_add');
Route::post('/event_store', 'EventsController@store')->name('event_store');
Route::get('/event_show/{id}', 'EventsController@show')->name('event_show');
Route::get('/event_edit/{id}', 'EventsController@edit')->name('event_edit');
Route::post('/event_update/{id}', 'EventsController@update')->name('event_update');
Route::get('/event_members_list/{id}', 'EventsController@getEventMembersList')->name('event_members_list');
Route::get('/event_delete/{id}', 'EventsController@delete')->name('event_delete');
Route::get('/event_member_delete/{id}', 'EventsController@deleteMember')->name('event_member_delete');





Route::get('/likes_list/{id}', 'StudentsController@getLikes')->name('likes_list');
Route::get('/likes_add/{who_id}/like/{whom_id}', 'StudentsController@addLikes')->name('likes_add');
Route::get('/likes_delete/{who_id}/unlike/{whom_id}', 'StudentsController@deleteLikes')->name('likes_delete');


Route::get('/dialogs_list/{id}', 'StudentsController@getDialogs')->name('dialogs_list');

Route::get('/referral_codes_list', "ReferralCodeController@index")->name('referral_codes_list');
Route::get('/referral_code_create', "ReferralCodeController@add")->name('referral_code_create');
Route::post('/referral_code_create', "ReferralCodeController@store")->name('referral_code_store');
Route::get('/referral_code_edit/{referral_code}', "ReferralCodeController@edit")->name('referral_code_edit');
Route::post('/referral_code_edit/{referral_code}', "ReferralCodeController@update")->name('referral_code_update');
Route::get('/referral_code_delete/{referral_code}', "ReferralCodeController@delete")->name('referral_code_delete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
