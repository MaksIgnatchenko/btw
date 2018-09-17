<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Rbac\Providers;

use App\Modules\Rbac\Listeners\AssignRolesSubscriber;;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class RbacEventsServiceProvider extends EventServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        AssignRolesSubscriber::class,
    ];
}
