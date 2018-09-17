<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

$this->group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::CUSTOMER, 'activeUser'],
    'prefix'     => 'review',
], function () {
    Route::apiResource('merchant', 'MerchantReviewController', [
        'only' => [
            'store'
        ]
    ]);
    Route::apiResource('product', 'ProductReviewController', [
        'only' => [
            'store'
        ]
    ]);
});
