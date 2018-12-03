<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

Route::group([
    'middleware' => ['auth:admin'],
    'prefix' => 'payments/income',
], function () {
    Route::get('index', 'IncomeController@index')->name('payments.income.index');
    Route::get('view/{order}', 'IncomeController@view')->name('payments.income.view');
    Route::put('update/{order}', 'IncomeController@update')->name('payments.income.update');
});
