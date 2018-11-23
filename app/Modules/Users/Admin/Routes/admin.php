<?php
/**
 * Created by Artem Petrov, Appus Studio on 11/1/17.
 */

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/', 'DashboardController@index')->name('admin');
    Route::get('/index', 'DashboardController@index');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::post('/change-password', 'DashboardController@changePassword')->name('admin.change-password');
});

Route::get('/login', 'LoginController@showLoginForm')->middleware('guest:admin')->name('login');
Route::post('/login', 'LoginController@login');
