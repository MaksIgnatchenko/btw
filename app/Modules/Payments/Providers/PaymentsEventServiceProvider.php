<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Payments\Providers;

use App\Modules\Payments\Listeners\AddPaymentOptionSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class PaymentsEventServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        AddPaymentOptionSubscriber::class,
    ];
}
