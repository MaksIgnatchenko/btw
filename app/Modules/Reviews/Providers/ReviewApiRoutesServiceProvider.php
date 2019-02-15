<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Providers;

use App\Modules\Reviews\Policies\ReviewPolicy;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/**
 * Class ReviewApiRoutesServiceProvider
 * @package App\Modules\Reviews\Providers
 */
class ReviewApiRoutesServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Reviews\Http\Controllers\Api';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . './../Routes/api.php');
    }

    public function register()
    {
        Gate::define('review.create', 'App\Modules\Reviews\Policies\ReviewPolicy@create');
    }
}
