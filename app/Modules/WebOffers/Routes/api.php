<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

Route::resource('web-offers', 'WebOffersAPIController', ['only' => ['index']]);
