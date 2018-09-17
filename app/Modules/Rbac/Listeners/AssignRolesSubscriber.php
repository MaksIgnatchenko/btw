<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Rbac\Listeners;

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Users\Events\AddRoleEventInterface;
use App\Modules\Users\Events\CustomerAddedEvent;
use App\Modules\Users\Events\MerchantAddedEvent;
use Laratrust\Traits\LaratrustUserTrait;

class AssignRolesSubscriber
{
    use LaratrustUserTrait;

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(
            MerchantAddedEvent::class,
            self::class . '@addMerchant'
        );

        $events->listen(
            CustomerAddedEvent::class,
            self::class . '@addCustomer'
        );
    }

    /**
     * @param AddRoleEventInterface $event
     */
    public function addCustomer(AddRoleEventInterface $event): void
    {
        $user = $event->getUser();
        $user->attachRole(RolesEnum::CUSTOMER);
    }

    /**
     * @param AddRoleEventInterface $event
     */
    public function addMerchant(AddRoleEventInterface $event): void
    {
        $user = $event->getUser();
        $user->attachRole(RolesEnum::MERCHANT);
    }
}
