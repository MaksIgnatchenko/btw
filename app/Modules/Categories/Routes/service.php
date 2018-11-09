<?php
Route::group([
    'middleware' => ['web'],
    'prefix' => 'categories',
], function () {
    Route::get('{category}/attributes', 'AttributeController@show');
    Route::get('tree', 'AttributeController@getAllAsTree');
});

