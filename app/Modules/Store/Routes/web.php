<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

Route::get('/', function () {
    return redirect()->route('store.products');
});

Route::group([
    'middleware' => ['auth:merchant'],
    'prefix' => 'products',
], function () {
    Route::get('/', 'StoreController@index')->name('store.products');
});
