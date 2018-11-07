<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

$this->group([
    'middleware' => ['auth:merchant'],
], function () {
    Route::apiResource('order', 'OrderController', ['except' => ['show']]);
});

Route::group([
    'middleware' => ['auth:merchant'],
    'prefix'     => 'order',
], function () {
    Route::get('/', 'OrderController@index')->name('order.index');
});
