<?php
/**
 * Created by Artem Petrov, Appus Studio on 11/1/17.
 */

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/', 'HomeController@index')->name('admin');
    Route::get('/index', 'HomeController@index');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::post('/change-password', 'HomeController@changePassword')->name('admin.change-password');

    Route::get('/merchants', 'MerchantController@index')->name('merchants.index');
    Route::get('/merchants/index', 'MerchantController@index');
    Route::get('/merchants/show/{id}', 'MerchantController@show')->name('merchants.show');
    Route::put('/merchants/change-status/{id}', 'MerchantController@changeStatus')->name('merchants.change-status');


    Route::get('/customers', 'CustomerController@index')->name('customers.index');
    Route::get('/customers/index', 'CustomerController@index');
    Route::get('/customers/show/{id}', 'CustomerController@show')->name('customers.show');
    Route::put('/customers/change-status/{id}', 'CustomerController@changeStatus')->name('customers.change-status');
});

Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login', 'LoginController@login');
