<?php

namespace App\Modules\Users\Admin\Providers;

use App\Modules\Users\Admin\Services\SalesAnalyticsService\Decorators\SalesAnalyticsResponseFormatDecorator;
use App\Modules\Users\Admin\Services\SalesAnalyticsService\Implemetations\UsaSalesAnalyticsService;
use App\Modules\Users\Admin\Services\SalesAnalyticsService\Interfaces\SalesAnalyticsInterface;
use Illuminate\Support\ServiceProvider;


class SalesAnalyticsServiceProvider extends ServiceProvider
{
//    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(SalesAnalyticsInterface::class, function () {
            return new SalesAnalyticsResponseFormatDecorator(new UsaSalesAnalyticsService());
        });
    }
}