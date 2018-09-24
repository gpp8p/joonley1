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
Route::get('/showRegistration','RegistrationController@showThisRequest')->name('showRegistration');
Route::get('/getReg', 'RegistrationController@getOneRegistration')->name('getOneRegistration');
Route::post('/approveReg', 'RegistrationController@approveRegistration')->name('approveReg');

Route::post('/userProfileEdit', 'ProfileController@showProfileEdit')->name('userProfileEdit');
Route::post('/userProfileEditSubmit', 'ProfileController@profileEditSubmit')->name('userProfileEditSubmit');
Route::post('/showUserCompany', 'ProfileController@editCompanyInformation')->name('showUserCompany');

Route::post('/feed', 'FeedController@show')->name('feed');
Route::get('/feed', 'FeedController@show')->name('feed');
Route::post('/favorites', 'FavoritesController@show')->name('favorites');
Route::get('/favorites', 'FavoritesController@show')->name('favorites');
Route::post('/orders', 'OrdersController@show')->name('orders');
Route::get('/orders', 'OrdersController@show')->name('orders');
Route::post('/specials', 'SpecialsController@show')->name('specials');
Route::get('/specials', 'SpecialsController@show')->name('specials');
Route::post('/search', 'SearchController@show')->name('search');
Route::get('/search', 'SearchController@show')->name('search');
Route::post('/messages', 'MessageController@show')->name('messages');
Route::get('/messages', 'MessageController@show')->name('messages');
Route::post('/more', 'MoreController@show')->name('more');
Route::get('/more', 'MoreController@show')->name('more');
Route::post('/admin', 'AdminController@show')->name('admin');
Route::get('/admin', 'AdminController@show')->name('admin');
Route::post('/products', 'ProductController@show')->name('products');
Route::get('/products', 'ProductController@show')->name('products');
Route::get('/newProduct', 'ProductController@newProduct')->name('newProduct');
Route::get('/showAllProductsAdmin', 'ProductController@getAllProducts')->name('showAllProductsAdmin');
Route::get('/showAllProducts', 'ProductController@getBuyerProductView')->name('showAllProducts');


Route::get('/getCats', 'NestedCategoryController@getCats')->name('getCats');
Route::get('/getOptions', 'OptionsController@getOptionsForCategory')->name('getOptions');
Route::get('/getOptionsWithParents', 'OptionsController@getOptionsForCategoryWithParents')->name('getOptionsWithParents');
Route::get('/optionTypes', 'OptionsController@getOptionTypes')->name('optionTypes');
Route::get('/optionValues', 'OptionsController@getOptionsForOptionType')->name('optionValues');


//Route::get('/multifileupload', 'HomeController@multifileupload')->name('multifileupload');
//Route::post('/multifileupload', 'HomeController@store')->name('multifileupload');

Route::post('/images-save', 'UploadImagesController@store')->name('images-save');
Route::post('/images-delete', 'UploadImagesController@destroy')->name('images-delete');
Route::get('/images-show', 'UploadImagesController@index')->name('images-show');
Route::get('/uploadImages', 'UploadImagesController@create')->name('uploadImages');

Route::post('/newProductSubmit', 'ProductController@processNewProductInitial')->name('newProductSubmit');
Route::post('/newProductCreate', 'ProductController@newProductCreate')->name('newProductCreate');
Route::post('/newProductAdd', 'ProductController@newProductAdd')->name('newProductAdd');

Route::get('/showProducts', 'ProductController@getProductsForLoggedInUser')->name('showProducts');
Route::post('/showOneProduct','ProductController@showOneProduct' )->name('showOneProduct');
Route::post('/productSearch', 'ProductController@productSearch')->name('productSearch');


Route::post('/addToFeed', 'FeedController@addToFeed')->name('addToFeed');
Route::post('/feedPreview', 'FeedController@showFeedPreview')->name('feedPreview');
Route::post('/previewBack', 'ProductController@showOneProduct')->name('previewBack');
Route::post('/cancelFeedAdd', 'ProductController@getProductsForLoggedInUser')->name('previewCancel');

Route::get('/createCategory', 'NestedCategoryController@showCategoryEdit')->name('createCategory');
Route::post('/createSubCategory', 'NestedCategoryController@createSubCategory')->name('createSubCategory');

Route::get('/test', function () {
//    $thisNestedCategory = new \App\NestedCategory();
//    $parentIds = $thisNestedCategory->getAllParentIds(17);
//    $immediateChildern = $thisNestedCategory->findChildNodes("Bracelets");
    $thisOptionsController = new \App\Http\Controllers\OptionsController();
    $thisOptionsController->getOptionTypes();
    return "<h2>Done!</h2>";
});



