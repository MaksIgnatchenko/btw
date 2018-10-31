<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 31.10.2018
 */

namespace App\Modules\Store\Providers;

use App\Modules\Store\Http\ViewComposers\StoreComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('store.store', StoreComposer::class);
    }
}
