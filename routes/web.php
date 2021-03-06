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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/verifyEmailFirst', function (){
    return view('emails.verifyEmailFirst');
})->name('verifyEmailFirst')->middleware('auth');

Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/resetPassword', 'HomeController@resetPassword')->name('home.password');

Route::post('/home/reset', 'HomeController@resetting')->name('home.reset');