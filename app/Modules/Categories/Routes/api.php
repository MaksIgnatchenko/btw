<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */


Route::get('/categories', 'CategoriesController@getCategoriesAction');
Route::get('/categories/{id}', 'CategoriesController@getCategoriesAction');