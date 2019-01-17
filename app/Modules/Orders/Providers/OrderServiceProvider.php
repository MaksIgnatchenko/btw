<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-17
 * Time: 18:09
 */

namespace App\Modules\Orders\Providers;

use App\Modules\Orders\Shipping\AfterShipping;
use App\Modules\Orders\Shipping\ShippingServiceInterface;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ShippingServiceInterface::class, function ($app) {
            return new AfterShipping(config('shipping.aftership.key'));
        });
    }
}
