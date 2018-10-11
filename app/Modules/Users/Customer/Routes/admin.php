<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('customers', 'CustomerController')->only(['index', 'show']);
});
