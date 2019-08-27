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

Route::get('staff', 'StaffController@index')->name('staff');
Auth::routes(['register' => false]);
Route::post('login', 'Auth\LoginController@loginMinecraft');
Route::get('vip', 'UserController@edit')->name('vip')->middleware('auth');
Route::post('vip', 'UserController@update')->middleware('auth');
Route::get('profile', 'UserController@index')->middleware('auth');
