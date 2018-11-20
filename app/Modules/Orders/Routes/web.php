<?php

Route::get('orders/search', 'SearchController@index')->middleware(['auth:merchant'])->name('orders.search');

$this->group([
    'middleware' => ['auth:merchant'],
], function () {
    Route::resource('orders', 'OrderController', ['as' => 'web'])
        ->only(['index', 'show', 'update']);
});
