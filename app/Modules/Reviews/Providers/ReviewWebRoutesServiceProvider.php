<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */

namespace App\Modules\Reviews\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class ReviewWebRoutesServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Reviews\Http\Controllers\Web';


    public function map()
    {
        Route::prefix('')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . './../Routes/web.php');
    }
}
