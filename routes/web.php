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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/', 'IntroController@show')->name('intro');

Route::get('/registerBuyer', 'SignUpBuyerController@showForm')->name('registerBuyer');
Route::post('/regBuyer', 'SignUpBuyerController@processForm')->name('regBuyer');

Route::get('/registerSeller', 'SignUpSellerController@showForm')->name('registerSeller');
Route::post('/regSeller', 'SignUpSellerController@processForm')->name('regSeller');