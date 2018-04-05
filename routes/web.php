<?php


Route::get('/', 'PageController@home')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function() {
    Route::get('/', 'Admin\DashboardController@index')->name('admin');
});