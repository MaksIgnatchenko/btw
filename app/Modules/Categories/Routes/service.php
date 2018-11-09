<?php

Route::get('categories/{category}/attributes', 'AttributeController@show')->middleware(['web']);
Route::get('categories/tree', 'AttributeController@getAllAsTree')->middleware(['web']);
