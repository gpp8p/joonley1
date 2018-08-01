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

Route::get('/registerBuyer', 'RegistrationController@showBuyerForm')->name('registerBuyer');
Route::post('/regBuyer', 'RegistrationController@processBuyerForm')->name('regBuyer');
Route::get('/checkId', 'RegistrationController@checkUserId')->name('checkId');

Route::get('/registerSeller', 'RegistrationController@showSellerForm')->name('registerSeller');
Route::post('/regSeller', 'RegistrationController@processSellerForm')->name('regSeller');

Route::get('/reviewRegistrations', 'RegistrationController@showRegistrationRequests')->name('reviewRegistrations');
Route::get('/getReg', 'RegistrationController@getOneRegistration')->name('getOneRegistration');
Route::post('/approveReg', 'RegistrationController@approveRegistration')->name('approveReg');

Route::post('/feed', 'FeedController@show')->name('feed');
Route::get('/feed', 'FeedController@show')->name('feed');
Route::post('/favorites', 'FavoritesController@show')->name('favorites');
Route::post('/orders', 'OrdersController@show')->name('orders');
Route::post('/specials', 'SpecialsController@show')->name('specials');
Route::post('/search', 'SearchController@show')->name('search');
Route::post('/messages', 'MessageController@show')->name('messages');
Route::post('/more', 'MoreController@show')->name('more');
Route::post('/admin', 'AdminController@show')->name('admin');

Route::get('/test', function () {
    $thisLocation = new \App\Locations;
    $thisProduct = $thisLocation->getProductsByLocation("Virginia");


});



