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
    /* --- Uses only as debug for server side social login --- */
    $this->get('login/{service}', 'AuthController@redirectToProvider')->where(['service' => '^(facebook|google)$']);
    /* -------------------------------------------------------- */
    $this->post('{service}/login', 'AuthController@socialLogin')->where(['service' => '^(facebook|google)$']);
    $this->get('{service}/callback', 'AuthController@handleProviderCallback');

    $this->post('login/google', 'AuthController@googleLogin');
    $this->post('login/facebook', 'AuthController@facebookLogin');
});

$this->group([
    'prefix' => 'password',
], function () {
    $this->post('change', 'Auth\ChangePasswordController@change')->name('password.change');
    $this->post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});

$this->post('register', 'RegisterController@register');
