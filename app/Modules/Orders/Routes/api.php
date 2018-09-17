<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

$this->group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::MERCHANT],
], function () {
    Route::apiResource('order', 'OrderController', ['except' => ['show']]);
});

Route::group([
    'middleware' => ['auth:api'],
    'prefix'     => 'order',
], function () {
    Route::get('/', 'OrderController@index')->name('order.index');
});
