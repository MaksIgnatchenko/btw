<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path' => [

        'migration'         => base_path('database/migrations/'),
        'model'             => app_path('Modules/Advert/Models/'),
        'datatables'        => app_path('Modules/Advert/DataTables/'),
        'repository'        => app_path('Modules/Advert/Repositories/'),
        'routes'            => app_path('Modules/Advert/Routes/admin.php'),
        'api_routes'        => app_path('Modules/Advert/Routes/api.php'),
        'request'           => app_path('Modules/Advert/Requests/Admin/'),
        'api_request'       => app_path('Modules/Advert/Requests/Api/'),
        'controller'        => app_path('Modules/Advert/Http/Controllers/Admin/'),
        'api_controller'    => app_path('Modules/Advert/Http/Controllers/Api/'),
        'test_trait'        => base_path('tests/traits/'),
        'repository_test'   => base_path('tests/'),
        'api_test'          => base_path('tests/'),
        'views'             => app_path('Modules/Advert/Resources/views/'),
        'schema_files'      => base_path('resources/model_schemas/'),
        'templates_dir'     => base_path('resources/infyom/infyom-generator-templates/'),
        'modelJs'           => base_path('resources/assets/js/models/'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'model'             => 'App\Modules\Advert\Models',
        'datatables'        => 'App\Modules\Advert\DataTables',
        'repository'        => 'App\Modules\Advert\Repositories',
        'controller'        => 'App\Modules\Advert\Http\Controllers\Admin',
        'api_controller'    => 'App\Modules\Advert\Http\Controllers\Api',
        'request'           => 'App\Modules\Advert\Requests\Admin',
        'api_request'       => 'App\Modules\Advert\Requests\Api',
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    */

    'templates'         => 'adminlte-templates',

    /*
    |--------------------------------------------------------------------------
    | Model extend class
    |--------------------------------------------------------------------------
    |
    */

    'model_extend_class' => 'Eloquent',

    /*
    |--------------------------------------------------------------------------
    | API routes prefix & version
    |--------------------------------------------------------------------------
    |
    */

    'api_prefix'  => 'api',
    'api_version' => 'v1',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [
        'softDelete' => false,
        'tables_searchable_default' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes
    |--------------------------------------------------------------------------
    |
    */

    'prefixes' => [
        'route' => '',  // using admin will create route('admin.?.index') type routes
        'path' => '',
        'view' => '',  // using backend will create return view('backend.?.index') type the backend views directory
        'public' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Add-Ons
    |--------------------------------------------------------------------------
    |
    */

    'add_on' => [
        'swagger'       => false,
        'tests'         => true,
        'datatables'    => true,
        'menu'          => [
            'enabled'       => false,
            'menu_file'     => 'layouts/menu.blade.php',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Timestamp Fields
    |--------------------------------------------------------------------------
    |
    */

    'timestamps' => [
        'enabled'       => true,
        'created_at'    => 'created_at',
        'updated_at'    => 'updated_at',
        'deleted_at'    => 'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Save model files to `App/Models` when use `--prefix`. see #208
    |--------------------------------------------------------------------------
    |
    */
    'ignore_model_prefix' => false,
];
