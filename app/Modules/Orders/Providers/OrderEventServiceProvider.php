<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.01.2018
 */

namespace App\Modules\Orders\Providers;

use App\Modules\Orders\Subscribers\CompletedTransactionOrdersSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class OrderEventServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        CompletedTransactionOrdersSubscriber::class,
    ];
}
