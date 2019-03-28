<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

$this->group([
    'middleware' => ['auth:customer', 'active'],
    'prefix' => 'products',
], function () {
    $this->get('/popular', 'ProductController@popular');
    $this->get('/search', 'ProductController@customerSearch');
    $this->get('/get/{id}', 'ProductController@show');
});

$this->group([
    'middleware' => ['auth:customer', 'active'],
    'prefix' => 'cart',
], function () {
    $this->get('/', 'CartController@getAll');
    $this->post('/', 'CartController@create');
    $this->put('/{id}', 'CartController@update');
    $this->delete('/{id}', 'CartController@delete');
    $this->get('/check', 'CartController@check');
});

$this->group([
    'middleware' => ['auth:customer', 'active'],
    'prefix' => 'transaction',
], function () {
    $this->post('/', 'TransactionController@create');
    $this->get('/token', 'TransactionController@generateToken')->name('transaction.token');
});
