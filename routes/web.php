<?php


Route::get('/', 'PageController@home')->name('home');

Auth::routes();


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index')->name('admin');
});