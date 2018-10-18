<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

Route::get('/', 'LoginController@index');

Route::group([
    'middleware' => 'web',
    'prefix' => 'auth/password',
], function () {
    $this->get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('reset', 'Auth\ResetPasswordController@reset');
    $this->get('success', 'Auth\ResetPasswordController@success');
});

/* --- Registration --- */
Route::group([
    'middleware' => ['web', 'auth:merchant'],
    'prefix' => 'registration',
], function () {
    $this->match(['get', 'post'], '/sign-up', 'RegistrationController@signUp');
    $this->match(['get', 'post'], '/contact-info', 'RegistrationController@contactInfo');
    $this->match(['get', 'post'], '/company-info', 'RegistrationController@aboutStore');
});
/* ------------------- */
