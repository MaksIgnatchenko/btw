<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        app_path('Modules/Users/Resources/views'),
        app_path('Modules/Content/Resources/views'),
        app_path('Modules/Categories/Resources/views'),
        app_path('Modules/Review/Resources/views'),
        app_path('Modules/Orders/Resources/views'),
        app_path('Modules/Advert/Resources/views'),
        app_path('Modules/WebOffers/Resources/views'),
        app_path('Modules/Csv/Resources/views'),

        base_path('resources/views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),

];
