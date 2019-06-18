<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('customers', 'CustomerController')->only(['index', 'show', 'update']);
});

Route::get('test', function() {
//    $order = \App\Modules\Orders\Models\Order::find(3);
    $order = new \App\Modules\Orders\Models\Order();
    dd($order->getTotalAmount());
});
