<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

$this->group([
    'middleware' => ['auth:customer'],
    'prefix' => 'reviews',
], function () {
    $this->get('merchant/{merchant}', 'ReviewController@showMerchantReviews');
    $this->get('product/{product}', 'ReviewController@showProductReviews');

    $this->post('/', 'ReviewController@create')->middleware('can:review.create');
});
