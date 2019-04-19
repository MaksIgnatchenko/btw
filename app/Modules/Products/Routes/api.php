<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

$this->group([
    'middleware' => ['auth:customer', 'active'],
    'prefix' => 'products',
], function () {
    $this->get('/popular', 'ProductController@popular')->name('api.products.popular');
    $this->get('/search', 'ProductController@customerSearch')->name('api.products.search');
    $this->get('/get/{id}', 'ProductController@show')->name('api.products.show');
});

$this->group([
    'middleware' => ['auth:customer', 'active'],
    'prefix' => 'cart',
], function () {
    $this->get('/', 'CartController@getAll')->name('api.carts.get');
    $this->post('/', 'CartController@create')->name('api.carts.create');
    $this->put('/{id}', 'CartController@update')->name('api.carts.update');
    $this->delete('/{id}', 'CartController@delete')->name('api.carts.delete');
    $this->get('/check', 'CartController@check')->name('api.carts.check');
});

$this->group([
    'middleware' => ['auth:customer', 'active'],
    'prefix' => 'transaction',
], function () {
    $this->post('/', 'TransactionController@create');
    $this->get('/token', 'TransactionController@generateToken')->name('transaction.token');
});
