<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.01.2018
 */

namespace App\Modules\Products\Providers;

use App\Modules\Products\Listeners\CreateProductSubscriber;
use App\Modules\Products\Listeners\TransactionCompletedSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class ProductEventServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        CreateProductSubscriber::class,
        TransactionCompletedSubscriber::class,
    ];
}
