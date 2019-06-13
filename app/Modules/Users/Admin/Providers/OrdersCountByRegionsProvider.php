<?php

namespace App\Modules\Users\Admin\Providers;

use App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Implemetations\UsaOrdersCountByRegionsService;
use App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Interfaces\OrdersCountByRegionsServiceInterface;
use Illuminate\Support\ServiceProvider;


class OrdersCountByRegionsProvider extends ServiceProvider
{
//    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(OrdersCountByRegionsServiceInterface::class, function ($app) {
            return new UsaOrdersCountByRegionsService();
        });
    }
}