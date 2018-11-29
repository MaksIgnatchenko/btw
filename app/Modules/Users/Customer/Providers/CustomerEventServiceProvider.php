<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 29.11.2018
 */

namespace App\Modules\Users\Customer\Providers;

use App\Modules\Users\Customer\Listeners\CustomerCreatedFromFacebookSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class CustomerEventServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        CustomerCreatedFromFacebookSubscriber::class,
    ];
}
