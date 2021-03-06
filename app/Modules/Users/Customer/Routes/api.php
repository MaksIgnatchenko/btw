<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

$this->group([
    'prefix' => 'auth',
], function () {
    $this->post('login', 'AuthController@login')->name('api.customer.login');
    $this->post('logout', 'AuthController@logout')->name('api.customer.logout');
    $this->post('refresh', 'AuthController@refresh')->name('api.customer.refresh');
    $this->post('me', 'AuthController@me')->name('api.customer.me');
    /* --- Uses only as debug for server side social login --- */
    if (\Illuminate\Support\Facades\App::environment(['local'])) {
        $this->get('{service}/login', 'AuthController@redirectToProvider')->where(['service' => '^(facebook|google)$']);
        $this->get('{service}/callback', 'AuthController@handleProviderCallback');
    }
    /* -------------------------------------------------------- */
    $this->post('login/{service}', 'AuthController@socialLogin')->where(['service' => '^(facebook|google)$'])->name('api.customer.social.login');
});

$this->group([
    'prefix' => 'password',
], function () {
    $this->post('change', 'Auth\ChangePasswordController@change')->name('password.change');
    $this->post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});

$this->group([
    'prefix' => 'wishlist', 'middleware' => ['auth:customer', 'active'],
], function () {
    $this->get('/', 'WishController@get')->name('api.customer.wish.list');
    $this->post('add/{product}', 'WishController@add')->name('api.customer.wish.add');
    $this->delete('remove/{product}', 'WishController@remove')->name('api.customer.wish.remove');
});

$this->post('register', 'RegisterController@register')->name('api.customer.register');


$this->group([
    'prefix' => 'profile',
    'middleware' => ['auth:customer', 'active'],
], function () {
    $this->put('/', 'Profile\ProfileController@update')->name('api.customer.profile.update');
    $this->post('/avatar', 'Profile\ProfileController@uploadAvatar')->name('api.customer.avatar.upload');
    $this->put('/delivery-information', 'Profile\DeliveryInformationController@store')->name('api.customer.delivery.update');
});

$this->group([
    'prefix' => 'recently-viewed',
    'middleware' => ['auth:customer', 'active'],
], function () {
    $this->get('/', 'RecentlyViewedController@get')->name('api.customer.recently-viewed.list');
    $this->delete('/{product}', 'RecentlyViewedController@remove')->name('api.customer.recently-viewed.remove');
    $this->delete('/', 'RecentlyViewedController@clear')->name('api.customer.recently-viewed.clear');
});
