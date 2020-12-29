<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', 'AdminUserController@index');
Route::post('/submit_login', 'AdminUserController@logins');
Route::post('/email_send','AdminUserController@email_send');

Route::group(['middleware'=>'logins'],function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'AdminUserController@get_logout');
	Route::post('/email_send','AdminUserController@email_send');
	Route::get('/change_password','AdminUserController@change_password');
	Route::post('/send_pass_var','AdminUserController@sendPasswordVar');
	Route::get('/dashboard', 'AdminUserController@index');
    Route::get('/manage_user', 'AdminUserController@manage_user');
	Route::get('/templates', 'TemplateController@Template');
    // Route::post('calendar-templates/fetch','TemplateController@CalendarTemplate')->name('calendartemplates.fetch');
    // Route::get('getParentData/{id}','TemplateController@getParentData');
    Route::get('/getParentData/{id}', 'TemplateController@getParentData');

});
