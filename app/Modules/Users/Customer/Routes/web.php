<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

Route::group([
    'prefix' => 'customer',
], function () {
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('customer.password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('customer.password.restore');
    $this->get('password/success', 'Auth\ResetPasswordController@success')->name('customer.password.success');
});
