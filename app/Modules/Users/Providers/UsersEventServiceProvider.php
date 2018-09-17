<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.02.2018
 */

namespace App\Modules\Users\Providers;

use App\Modules\Users\Subscribers\MerchantAddressChangedSubscriber;
use App\Modules\Users\Subscribers\UsersCreatedSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class UsersEventServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        MerchantAddressChangedSubscriber::class,
        UsersCreatedSubscriber::class,
    ];
}
