<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

$this->group([
    'middleware' => ['auth:api'],
], function () {
    Route::resource('notifications', 'NotificationAPIController', ['only' => ['index', 'destroy']]);

    Route::resource('push-settings', 'PushSettingsAPIController', ['only' => ['index', 'store']]);
});
