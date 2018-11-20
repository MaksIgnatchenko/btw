<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

$this->group([
    'middleware' => ['auth:customer'],
], function () {
    Route::apiResource('orders', 'OrderController', ['only' => ['index', 'show']]);
});
