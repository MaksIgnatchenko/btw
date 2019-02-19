<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */
$this->group([
    'middleware' => ['auth:admin'],
    'prefix' => 'reviews',
], function () {
    $this->get('{reviewType}', 'ReviewController@index')->name('reviews.index');
    $this->get('{reviewType}/{id}', 'ReviewController@show')->name('reviews.show');
    $this->put('{reviewType}/{id}', 'ReviewController@update')->name('reviews.update');
});
