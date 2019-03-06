<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 19.02.2019
 */

namespace App\Modules\Users\Customer\Listeners;

use App\Modules\Users\Customer\Events\CustomerWatchedProductEvent;

/**
 * Class CustomerWatchedProductSubscriber
 * @package App\Modules\Users\Customer\Listeners
 */
class CustomerWatchedProductSubscriber
{
    /**
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(CustomerWatchedProductEvent::class, self::class . '@watchProduct');
    }

    /**
     * @param CustomerWatchedProductEvent $event
     */
    public function watchProduct(CustomerWatchedProductEvent $event): void
    {
        $recently = $event->getCustomer()->recentlyViewed()->find($event->getProduct()->id);

        if (null === $recently) {
            $event->getCustomer()->recentlyViewed()->attach($event->getProduct());
        } else {
            $event->getCustomer()->recentlyViewed()
                ->updateExistingPivot($event->getProduct()->id, [
                    'updated_at' => now(),
                ]);
        }
    }
}
