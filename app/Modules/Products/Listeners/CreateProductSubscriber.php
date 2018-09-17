<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.12.2017
 */

namespace App\Modules\Products\Listeners;

use App\Modules\Products\Events\AddProductEvent;
use App\Modules\Products\Jobs\AddProductExternalRatingJob;

class CreateProductSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(AddProductEvent::class, self::class . '@addExternalRating');
    }

    /**
     * @param AddProductEvent $event
     */
    public function addExternalRating(AddProductEvent $event): void
    {
        dispatch(new AddProductExternalRatingJob($event->getProduct()));
    }
}
