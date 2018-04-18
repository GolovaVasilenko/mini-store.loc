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

Route::get('/', 'PageController@home')->name('home');

Auth::routes();

Route::group(['prefix' => 'secret', 'namespace' => 'Admin', 'middleware' => ['web', 'auth']], function() {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/products', 'ProductController@index')->name('admin.products');

    Route::get('/brands', 'BrandController@index')->name('admin.brands');

    Route::get('/categories', 'CategoryController@index')->name('admin.categories');

    Route::get('/attributes', 'AttributeController@index')->name('admin.attributes');
});

Route::get('/profile', 'ProfileController@index', ['middleware' => ['web', 'auth']])->name('profile');