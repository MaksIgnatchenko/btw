<?php

Route::resource('attributes', 'AttributeController')->only([
    'show',
])->middleware(['web']);