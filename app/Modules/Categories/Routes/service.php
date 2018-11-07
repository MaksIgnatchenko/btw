<?php

Route::get('categories/{id}/attributes', 'AttributeController@show')->middleware(['web']);
