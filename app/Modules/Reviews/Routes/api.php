<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

$this->group([
    'middleware' => ['auth:customer'],
    'prefix' => 'reviews',
], function () {
    $this->get('{type}/{merchant}', 'ReviewController@showReviews');

    $this->post('/', 'ReviewController@create')->middleware('can:review.create');
});
