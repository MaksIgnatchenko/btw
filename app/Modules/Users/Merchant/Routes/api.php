<?php

$this->get('{merchant}', 'MerchantController@get');
$this->get('{merchant}/products', 'MerchantController@getProducts');