<?php

Route::get('categories/{category}/attributes', 'AttributeController@show')->middleware(['web']);
