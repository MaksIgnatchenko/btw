<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

Route::resource('advert', 'AdvertAPIController', ['only' => ['index']]);
