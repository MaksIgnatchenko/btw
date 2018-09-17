<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

Route::group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::CUSTOMER, 'activeUser'],
], function () {
    Route::apiResource('wish', 'WishController', ['only' => ['store']]);
});

Route::group([
    'middleware' => ['auth:api', 'activeUser'],
], function () {
    Route::apiResource('wish', 'WishController', ['only' => ['index']]);
});

Route::group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::MERCHANT, 'activeUser'],
], function () {
    Route::apiResource('bid', 'BidController', ['only' => ['store']]);
    Route::apiResource('declined-wish', 'DeclinedWishController', ['only' => ['store']]);
});
