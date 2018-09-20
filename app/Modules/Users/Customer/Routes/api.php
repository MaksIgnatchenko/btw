<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

$this->group([
    'prefix' => 'auth',
], function () {
    $this->post('login', 'AuthController@login');
    $this->post('logout', 'AuthController@logout');
    $this->post('refresh', 'AuthController@refresh');
    $this->post('me', 'AuthController@me');
});

$this->group([
    'prefix' => 'password',
], function () {
    $this->post('change', 'Auth\ChangePasswordController@change')->name('password.change');
    $this->post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});

$this->post('register', 'RegisterController@register');
