<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 12.10.2018
 */

Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('merchants', 'MerchantController')->only(['index', 'show', 'update']);
});