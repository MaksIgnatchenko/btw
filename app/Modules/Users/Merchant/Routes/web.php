<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

Route::get('/', 'LoginController@index')->name('index');
Route::post('/login', 'LoginController@login')->name('merchant.login');

Route::group([
    'middleware' => 'web',
    'prefix' => 'auth/password',
], function () {
    $this->get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('merchant.password.request');
    $this->get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('merchant.password.email');
    Route::post('password/request', 'Auth\ResetPasswordController@reset')->name('password.request');
});

/* --- Registration --- */
Route::group([
    'middleware' => ['web'],
    'prefix' => 'registration',
], function () {
    $this->get('sign-up', 'RegistrationController@signUp')->name('merchant.registration.sign-up');
    $this->post('set-account-info', 'RegistrationController@setAccountInfo')->name('merchant.registration.set-account-info');
    $this->post('set-contact-info', 'RegistrationController@setContactInfo')->name('merchant.registration.set-contact-info');
    $this->post('set-company-info', 'RegistrationController@setStoreInfo')->name('merchant.registration.set-store-info');
    $this->post('restore-contact-info', 'RegistrationController@restoreContactData')->name('merchant.registration.restore-contact-info');
});
/* ------------------- */

/* --- Geography --- */
Route::group([
    'middleware' => ['web'],
    'prefix' => 'service/geography',
], function () {
    $this->get('get', 'GeographyController@getObjects');
    $this->get('country-phone-code', 'GeographyController@getCountryPhoneCode');
});
/* ------------------- */