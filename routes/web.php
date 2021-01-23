<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::group(['prefix'=>'doctor'], function () {
    Route::get('/login','Auth\Login\DoctorLoginController@showLoginForm')->name('doctorLogin');
    Route::post('/login','Auth\Login\DoctorLoginController@login')->name('doctorLogin');
    Route::post('/logout','Auth\Login\DoctorLoginController@logout')->name('doctorLogout');

    Route::get('/home','DoctorController@home')->name('doctorHome');
});

Route::group(['prefix'=>'secretary'], function () {
    Route::get('/login','Auth\Login\SecretaryLoginController@showLoginForm')->name('secretaryLogin');
    Route::post('/login','Auth\Login\SecretaryLoginController@login')->name('secretaryLogin');
    Route::post('/logout','Auth\Login\SecretaryLoginController@logout')->name('secretaryLogout');

    Route::get('/home','SecretaryController@home')->name('secretaryHome');
});

Route::get('/management/doctor/profile', 'DoctorController@profile')->name('doctor.profile');
Route::get('/management/secretary/profile', 'SecretaryController@profile')->name('secretary.profile');
//
// Route::resource('clinic', 'ClinicController');
Route::resource('management/doctor', 'DoctorController');
Route::get('/ajax/doctor/getAppointmentsForDoctor','DoctorController@getAppointmentsForDoctor')->name('doctor.ajax.getAppointmentsForDoctor');
Route::get('/ajax/doctor/getPrescriptionsForDoctor','DoctorController@getPrescriptionsForDoctor')->name('doctor.ajax.getPrescriptionsForDoctor');
Route::get('/ajax/doctor/getOrientationLettersForDoctor','DoctorController@getOrientationLettersForDoctor')->name('doctor.ajax.getOrientationLettersForDoctor');
Route::get('/ajax/doctor/getAllDoctor','DoctorController@getAllDoctor')->name('doctor.ajax.getAllDoctor');
Route::get('/ajax/doctor/getAllDoctorForDropdown','DoctorController@getAllDoctorForDropdown')->name('doctor.ajax.getAllDoctorForDropdown');

Route::resource('management/secretary', 'SecretaryController', ['except' => ['show'] ] );
Route::get('/ajax/secretary/getAllSecretary','SecretaryController@getAllSecretary')->name('secretary.ajax.getAllSecretary');

// Route::resource('patient', 'PatientController');
Route::get('/ajax/patient/getAllPatientForDropdown','PatientController@getAllPatientForDropdown')->name('patient.ajax.getAllPatientForDropdown');
Route::resource('management/appointment', 'AppointmentController', ['except' => ['show'] ] );
Route::get('/ajax/appointment/getAllAppointment','AppointmentController@getAllAppointment')->name('appointment.ajax.getAllAppointment');

// Route::resource('prescription', 'PrescriptionController');
// Route::resource('prescriptionline', 'PrescriptionLineController');
// Route::resource('orientationletter', 'OrientationLetterController');
// Route::resource('imagery', 'ImageryController');
//

//generating when using Auth::routes() but don't needed instead i just define the needed route
//for registration
// Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register','Auth\RegisterController@register');
//for login
// Route::get('login','Auth\LoginController@showLoginForm')->name('login');
// Route::post('login','Auth\LoginController@login');
// Route::post('logout','Auth\LoginController@logout')->name('logout');
//GET|HEAD|login                 |login           |Auth\LoginController@showLoginForm
//POST    |login                 |                |Auth\LoginController@login
//POST    |logout                |logout          |Auth\LoginController@logout
//GET|HEAD|password/confirm      |password.confirm|Auth\ConfirmPasswordController@showConfirmForm
//POST    |password/confirm      |                |Auth\ConfirmPasswordController@confirm
//POST    |password/email        |password.email  |Auth\ForgotPasswordController@sendResetLinkEmail
//GET|HEAD|password/reset        |password.request|Auth\ForgotPasswordController@showLinkRequestForm
//POST    |password/reset        |password.update |Auth\ResetPasswordController@reset
//GET|HEAD|password/reset/{token}|password.reset  |Auth\ResetPasswordController@showResetForm
//GET|HEAD|register              |register        |Auth\RegisterController@showRegistrationForm
//POST    |register              |                |Auth\RegisterController@register
//Auth::routes();
