<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 01.11.2018
 */

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('products/search', 'SearchController@index')->middleware(['auth:merchant'])->name('products.search');
Route::get('products/filter', 'SearchController@index')->middleware(['auth:merchant'])->name('products.filter');
Route::resource('products', 'ProductController')->middleware(['auth:merchant']);
