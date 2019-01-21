<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

namespace App\Modules\Orders\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class OrderWebhookRouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Orders\Http\Controllers\Webhook';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('webhook')
            ->namespace($this->namespace)
            ->group(__DIR__ . './../Routes/webhook.php');
    }
}
