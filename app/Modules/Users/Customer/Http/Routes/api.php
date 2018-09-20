<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

$this->group([
    'middleware' => 'api',
    'prefix'     => 'auth'
], function () {
    $this->post('login', 'AuthController@login');
    $this->post('logout', 'AuthController@logout');
    $this->post('refresh', 'AuthController@refresh');
    $this->post('me', 'AuthController@me');
});

$this->group(['middleware' => 'api', 'prefix' => 'password'], function () {
    $this->post('change', 'Auth\ChangePasswordController@change')->name('password.change');
});

$this->group(['middleware' => 'auth:api', 'prefix' => 'settings'], function () {
    $this->get('get', 'UserSettingsController@get')->name('settings.get');
    $this->post('set', 'UserSettingsController@set')->name('settings.set');
    $this->post('push-token', 'DeviceController@setPushToken')->name('settings.pushToken');
});

$this->group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::MERCHANT, 'activeUser'],
    'prefix'     => 'users/update'
], function () {
    $this->put('payment-option', 'UpdateUsersController@paymentOption')->name('update.payment-option');
});

$this->group(['middleware' => 'auth:api', 'prefix' => 'users/update'], function () {
    $this->post('push-token', 'UpdateUsersController@pushToken')->name('update.push-token');
});

$this->group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::CUSTOMER, 'activeUser'],
    'prefix'     => 'customers/update'
], function () {
    $this->post('delivery-address', 'UpdateCustomersController@deliveryAddress')
        ->name('update-customers.delivery-address');
    $this->post('address', 'UpdateCustomersController@address')->name('update-customers.address');
});

$this->group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::MERCHANT, 'activeUser'],
    'prefix'     => 'merchants/update'
], function () {
    $this->post('address', 'UpdateMerchantsController@address')->name('update-merchants.address');
});

$this->group([
    'middleware' => ['auth:api', 'role:' . \App\Modules\Rbac\Enum\RolesEnum::MERCHANT, 'activeUser'],
    'prefix'     => 'merchants/categories'
], function () {
    $this->get('get', 'MerchantCategoriesController@get')->name('categories-merchants.get');
    $this->post('set', 'MerchantCategoriesController@set')->name('categories-merchants.post');
});

$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->post('register/customer', 'RegisterController@registerCustomerAction');
$this->post('register/merchant', 'RegisterController@registerMerchantAction');
