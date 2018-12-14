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

Route::pattern('id','([0-9]*)');
Route::pattern('name','(.*)');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Watch'], function() {
    Route::resource('/', 'ProductController', ['only' => 'index']);
    Route::get('{name}/{id}.html', 'ProductController@detail')->name('product.detail');
    Route::get('filter', 'ProductController@filter')->name('product.filter');

    Route::resource('cart', 'CartController', ['only' => ['index', 'create', 'update', 'destroy']])->middleware('auth');
    Route::get('changecart', 'CartController@changeCart')->name('cart.change')->middleware('auth');
    Route::get('info', 'CartController@inputInfo')->name('cart.info')->middleware('auth');
    Route::post('confirm', 'CartController@confirm')->name('cart.confirm')->middleware('auth');
    Route::post('checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');

    Route::resource('profile', 'ProfileController', ['only' => ['index', 'update']])->middleware('auth');
    Route::get('your-order', 'ProfileController@yourOrder')->name('profile.order')->middleware('auth');

    Route::resource('rating', 'RatingController', ['only' => 'index'])->middleware('auth');
    Route::get('changerating', 'RatingController@changeRating')->name('rating.changerating')->middleware('auth');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::group(['middleware' => 'admin'], function() {
        Route::resource('', 'DashboardController', ['only' => 'index'])->names(['index' => 'dashboard.index']);

        Route::resource('user', 'UserController', ['except' => 'show']);
        Route::get('changeActive/user', 'UserController@changeActive')->name('user.active');

        Route::resource('order', 'OrderController', ['only' => ['index', 'show', 'destroy']]);
        Route::get('order/confirm/{id}', 'OrderController@confirm')->name('order.confirm');
        Route::get('changeStatus/order', 'OrderController@changeStatus')->name('order.status');

        Route::resource('category', 'CategoryController', ['expect' => 'show']);

        Route::resource('product', 'ProductController', ['except' => 'show']);
        Route::get('product/changeCategory', 'ProductController@changeCategory')->name('product.change_category');
        Route::post('product/import', 'ProductController@import')->name('product.import');
        Route::get('product/changeStrap', 'ProductController@changeStrap')->name('product.change_strap');
        Route::get('product/changeSkin', 'ProductController@changeSkin')->name('product.change_skin');
        Route::get('product/changeEnergy', 'ProductController@changeEnergy')->name('product.change_energy');
    });
});

Route::get('/auth/{provide}', 'SocialAuthController@redirect')->name('social.login');
Route::get('/auth/{provide}/callback', 'SocialAuthController@callback');
