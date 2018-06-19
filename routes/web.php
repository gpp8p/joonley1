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

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/', 'IntroController@show')->name('intro');

Route::get('test', function () {
//    $thisCompany = new \App\Company;
//    $thisCompanyId = 3;
//    $thisCompany->editCompany($thisCompanyId, 'Cheap Trinkets Unlimited', 'www.cheaptrinkets.com', '451) 307-2650 x71724', 9, [1, 2]);
//    $newCompanyId = $thisCompany->addNewCompany('New Company Name3', 'newweb.com', '999-999-9999', 2, 1);
    $thisCollection = new \App\Collections;

/*
    try {
        $collectionId = $thisCollection->addCollection('Fake Glory', 'fglory', 'Zirconimu rings for sale', 1, 'open', 2);
    } catch (Exception $e) {
        return 'exception'.$e->getMessage();
    }
    try {
        $thisCollection->removeCollection($collectionId);
    } catch (Exception $e) {
        return 'exception'.$e->getMessage();
    }
*/

    $thisNestedCategory = new \App\NestedCategory;
    $thisNestedCategory->addCategory('Jewelry', 'Jewelry', 'Select Product Category');
    return 'done!';
});