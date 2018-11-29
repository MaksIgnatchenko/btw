<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 29.11.2018
 */

namespace App\Modules\Users\Customer\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Modules\Users\Customer\Events\CustomerCreatedFromFacebookEvent;

class CustomerCreatedFromFacebookSubscriber
{
    public function subscribe($events): void
    {
        $events->listen(CustomerCreatedFromFacebookEvent::class, self::class . '@storeAvatar');
    }

    public function storeAvatar(CustomerCreatedFromFacebookEvent $event): void
    {
        Storage::disk('public')
            ->put(config('wish.storage.customers.avatar_path')
                . '/'
                . $event->getAvatarImageName(), $event->getAvatarImage());
    }
}
