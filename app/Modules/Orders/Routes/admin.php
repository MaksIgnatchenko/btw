<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

Route::group([
    'middleware' => ['auth:admin'],
    'prefix'     => 'payments/income',
], function () {
    Route::get('index', 'IncomeController@index')->name('payments.income.index');
    Route::get('view/{key}', 'IncomeController@view')->name('payments.income.view');
    Route::put('update/{key}', 'IncomeController@update')->name('payments.income.update');
});

Route::group([
    'middleware' => ['auth:web'],
    'prefix'     => 'payments',
], function () {
    Route::resource('outcome', 'OutcomeController')->except(['show']);
    Route::get('outcome/merchant-orders', 'OutcomeController@merchantOrders')->name('outcome.merchant-orders');
});
