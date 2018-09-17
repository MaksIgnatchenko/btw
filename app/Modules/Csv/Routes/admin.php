<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

$this->group([
    'middleware' => ['auth:web'],
], function () {
    Route::resource('csv', 'CsvController', ['only' => ['index', 'show']]);
});
