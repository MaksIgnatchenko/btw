<?php

$this->group([
    'middleware' => ['auth:merchant', 'active'],
], function () {
    Route::get('orders/search', 'SearchController@index')->name('orders.search');
    Route::resource('orders', 'OrderController', ['as' => 'web'])
        ->only(['index', 'show', 'update']);
});
