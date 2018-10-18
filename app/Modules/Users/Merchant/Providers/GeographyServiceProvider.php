<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Providers;

use App\Modules\Users\Merchant\Services\Geography\GeographyService;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Carbon\Laravel\ServiceProvider;

class GeographyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GeographyServiceInterface::class, function () {
            return new GeographyService();
        });
    }

    public function provides()
    {
        return [GeographyServiceInterface::class];
    }
}