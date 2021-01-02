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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register');


Route::get('/home', 'HomeController@index')->name('home');


//generating when using Auth::routes() but don't needed instead i just define the needed route
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
