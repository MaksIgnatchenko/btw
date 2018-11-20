<?php

$this->group([
    'middleware' => ['auth:merchant'],
], function () {
    Route::get('orders/search', 'SearchController@index')->name('orders.search');
    Route::resource('orders', 'OrderController', ['as' => 'web'])
        ->only(['index', 'show', 'update']);
});
