<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

Route::group([
    'middleware' => 'api',
    'prefix'     => 'content'
], function () {
    Route::get('/get/{key}', 'ContentController@get');
});
