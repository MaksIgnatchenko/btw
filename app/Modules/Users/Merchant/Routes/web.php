<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

Route::group([
    'middleware' => 'web',
    'prefix'     => 'auth'
], function () {
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    $this->get('password/success', 'Auth\ResetPasswordController@success');
});

/* --- Registration --- */
Route::group([
    'middleware' => ['web', 'auth:merchant'],
    'prefix'     => 'auth',
], function () {
    $this->match(['get', 'post'], '/sign-up', 'RegistrationController@signUp');
    $this->match(['get', 'post'], '/contact-info', 'RegistrationController@contactInfo');
    $this->match(['get', 'post'], '/company-info', 'RegistrationController@aboutStore');
});
/* ------------------- */
