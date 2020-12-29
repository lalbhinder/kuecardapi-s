<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('signup', 'SignupController@SignUp');
Route::post('login', 'LoginController@login');
Route::post('confirm-comany', 'SignupController@ConfirmCompany');
Route::post('forgot-password', 'ForgotController@ForgetPassword');
Route::post('update-profile', 'SignupController@UpdateUserRecord');
Route::post('guest-signup', 'SignupController@GuestSignUp');
Route::post('book-appointment','ScheduleController@BookAppointment');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout','LoginController@logout');
    Route::get('getdays','ScheduleController@GetDays');
    Route::post('save-slots','ScheduleController@SetSlots');
    Route::get('show-slots','ScheduleController@ShowSlots');
    Route::get('upcoming-appointments','ScheduleController@UpcomingAppointments');
    Route::get('cancel-appointments','ScheduleController@CancelAppointments');
    Route::post('qr','QrController@Qr');
    // Route::get('get-qr','QrController@ShowQr');
    Route::post('counter','DashboardController@Counter');
    Route::post('contact','ContactController@Contact');






});
