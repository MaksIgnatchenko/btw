<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//    $this->post('password/reset', 'Auth\ResetPasswordController@reset');
//    $this->get('password/success', 'Auth\ResetPasswordController@success');
});
