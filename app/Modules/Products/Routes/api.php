<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

$this->group([
    'middleware' => ['api'],
    'prefix'     => 'products',
], function () {
    $this->post('/set', 'ProductController@set')->middleware('activeUser');
    $this->post('/update', 'ProductController@update')->middleware('activeUser');

    $this->get('/get', 'ProductController@get');

    $this->get('/price-breakers', 'ProductController@priceBreakers');
});

$this->group([
    'middleware' => ['auth:customer'],
    'prefix' => 'products',
], function () {
    $this->get('/price-breakers', 'ProductController@priceBreakers');
    $this->get('/popular', 'ProductController@popular');
    $this->get('/search', 'ProductController@customerSearch');
    $this->get('/other-merchant-products', 'ProductController@otherMerchantProducts');
});

$this->group([
    'prefix'     => 'products',
], function () {
    $this->get('/get/{id}', 'ProductController@getSingle');
});

$this->group([
    'middleware' => ['auth:customer'],
    'prefix'     => 'cart',
], function () {
    $this->get('/', 'CartController@getAll');
    $this->post('/', 'CartController@create');
    $this->put('/{id}', 'CartController@update');
    $this->delete('/{id}', 'CartController@delete');
    $this->get('/check', 'CartController@check');
});

$this->group([
    'middleware' => ['auth:api', 'activeUser'],
    'prefix'     => 'transaction',
], function () {
    $this->post('/', 'TransactionController@create');
});