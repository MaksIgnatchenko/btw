<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 07.11.2018
 */

namespace App\Modules\Categories\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class ServiceRouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Categories\Http\Controllers\Service';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . './../Routes/service.php');
    }
}
