<?php
/**
 * Created by Artem Petrov, Appus Studio on 11/1/17.
 */

namespace App\Modules\Users\Admin\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Users\Admin\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . './../Routes/admin.php');
    }
}
