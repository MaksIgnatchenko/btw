<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

Route::group(['middleware' => ['auth:web']], function () {
    Route::resource('logs', 'LogController', ['only' => ['index']]);
});
