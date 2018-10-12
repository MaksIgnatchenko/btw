<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.04.2018
 */

namespace App\Modules\Users\Subscribers;

use App\Modules\Notifications\Models\PushMerchant;
use App\Modules\Notifications\Repositories\PushMerchantRepository;
use App\Modules\Users\Events\MerchantAddedEvent;

class UsersCreatedSubscriber
{
    /** @var PushMerchantRepository $pushMerchantRepository */
    protected $pushMerchantRepository;

    /**
     * NotificationSubscriber constructor.
     */
    public function __construct()
    {
        $this->pushMerchantRepository = app(PushMerchantRepository::class);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(MerchantAddedEvent::class, static::class . '@createMerchantPushSettings');
    }

    /**
     * @param MerchantAddedEvent $event
     */
    public function createMerchantPushSettings(MerchantAddedEvent $event): void
    {
        $merchant = $event->getMerchant();

        $pushMerchant = new PushMerchant();
        $pushMerchant->merchant_id = $merchant->id;

        $this->pushMerchantRepository->save($pushMerchant);
    }
}
