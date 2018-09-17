<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.02.2018
 */

namespace App\Modules\Notifications\Providers;

use App\Modules\Notifications\Subscribers\NotificationSubscriber;
use App\Modules\Notifications\Subscribers\PushSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class NotificationEventServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        PushSubscriber::class,
        NotificationSubscriber::class,
    ];
}
