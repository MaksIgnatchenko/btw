<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

Route::group(['middleware' => ['auth:admin']], function () {

    Route::get('/content', 'ContentController@index')->name('content');
    Route::get('/content/about-us', 'ContentController@aboutUs')->name('content.about-us');
    Route::put('/content/update/{key}', 'ContentController@update')->name('content.update');

});