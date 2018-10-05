<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.11.2017
 */

Route::group([
    'middleware' => ['auth:admin'],
    'prefix'     => 'categories',
], function () {
    Route::get('/', 'CategoriesController@index')->name('categories.index');
    Route::get('/index', 'CategoriesController@index');
    Route::get('/add', 'CategoriesController@add')->name('categories.add');
    Route::get('/add-subcategory/{id}', 'CategoriesController@addSubcategory')->name('categories.add-subcategory');

    Route::post('/save-category', 'CategoriesController@saveCategory')->name('categories.save-category');
    Route::post('/save-subcategory', 'CategoriesController@saveSubcategory')->name('categories.save-subcategory');

    Route::get('/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
    Route::post('/edit/{id}', 'CategoriesController@update')->name('categories.update');
    Route::delete('/delete/{id}', 'CategoriesController@delete')->name('categories.delete');
});
