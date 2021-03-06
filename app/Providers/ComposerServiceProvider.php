<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 01.11.2018
 */

namespace App\Providers;

use App\Http\ViewComposers\GlobalComposer;
use App\Http\ViewComposers\SettingsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer(['*.web.*', 'merchants.auth.*'], GlobalComposer::class);
        View::composer(['layouts.merchants.app'], SettingsComposer::class);
    }
}
