<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 04.03.2019
 */
$this->group([
    'middleware' => ['auth:merchant', 'active'],
    'prefix' => 'reviews',
], function () {
    $this->get('{type}/{id}', 'ReviewController@showReviews')->name('reviews.list');
});