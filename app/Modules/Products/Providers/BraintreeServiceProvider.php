<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 6.11.2018
 */

namespace App\Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Braintree_Gateway::class, function ($app) {
            return new \Braintree_Gateway([
                'environment' => env('BT_ENVIRONMENT'),
                'merchantId' => env('BT_MERCHANT_ID'),
                'publicKey' => env('BT_PUBLIC_KEY'),
                'privateKey' => env('BT_PRIVATE_KEY'),
            ]);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [\Braintree_Gateway::class];
    }
}