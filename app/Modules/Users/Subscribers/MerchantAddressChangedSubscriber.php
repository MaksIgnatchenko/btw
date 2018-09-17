<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.02.2018
 */

namespace App\Modules\Users\Subscribers;

use App\Modules\Users\Enums\MerchantStatusEnum;
use App\Modules\Users\Events\MerchantAddressChangedEvent;
use App\Modules\Users\Repositories\MerchantRepository;

class MerchantAddressChangedSubscriber
{
    /** @var MerchantRepository $merchantRepository */
    protected $merchantRepository;

    /**
     * NotificationSubscriber constructor.
     */
    public function __construct()
    {
        $this->merchantRepository = app(MerchantRepository::class);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(MerchantAddressChangedEvent::class, static::class . '@setPendingStatus');
    }

    /**
     * @param MerchantAddressChangedEvent $event
     */
    public function setPendingStatus(MerchantAddressChangedEvent $event): void
    {
        $merchant = $event->getMerchant();
        $merchant->status = MerchantStatusEnum::PENDING;
        $this->merchantRepository->save($merchant);
    }
}
