<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

Route::group([
    'middleware' => 'web',
    'prefix' => 'store',
], function () {
    Route::get('/', 'StoreController@index')->name('store.index');
});
