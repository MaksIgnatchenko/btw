<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 01.11.2018
 */

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', 'ProductController')->middleware(['auth:merchant']);
