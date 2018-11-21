<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.11.2018
 */

namespace App\Modules\Orders\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class OrderWebRoutesServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Orders\Http\Controllers\Web';

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
            ->group(__DIR__ . './../Routes/web.php');
    }
}