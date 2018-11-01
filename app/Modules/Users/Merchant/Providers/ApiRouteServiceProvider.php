<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.11.2018
 */

namespace App\Modules\Users\Merchant\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ApiRouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Users\Merchant\Http\Controllers\Api';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('api/merchant')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . './../Routes/api.php');
    }
}
