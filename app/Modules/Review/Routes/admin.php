<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

Route::group(['prefix' => 'review/product', 'middleware' => ['auth:web']], function () {
    Route::get('index', 'ProductReviewController@index')->name('review.products.index');
    Route::get('view/{id}', 'ProductReviewController@view')->name('review.products.view');
    Route::put('update/{id}', 'ProductReviewController@update')->name('review.products.update');
    Route::delete('delete/{id}', 'ProductReviewController@delete')->name('review.products.delete');
});

Route::group(['prefix' => 'review/merchant', 'middleware' => ['auth:web']], function () {
    Route::get('index', 'MerchantReviewController@index')->name('review.merchants.index');
    Route::get('view/{id}', 'MerchantReviewController@view')->name('review.merchants.view');
    Route::put('update/{id}', 'MerchantReviewController@update')->name('review.merchants.update');
    Route::delete('delete/{id}', 'MerchantReviewController@delete')->name('review.merchants.delete');
});
