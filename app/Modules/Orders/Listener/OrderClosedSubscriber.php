<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 12.04.2019
 */

namespace App\Modules\Orders\Listener;


use App\Modules\Orders\Events\OrderClosedEvent;
use App\Modules\Products\Models\Product;
use Illuminate\Support\Facades\Log;

/**
 * Class OrderClosedSubscriber
 * @package App\Modules\Orders\Listener
 */
class OrderClosedSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(OrderClosedEvent::class, self::class . '@recountProducts');
    }

    /**
     * @param OrderClosedEvent $event
     */
    public function recountProducts(OrderClosedEvent $event)
    {
        $order = $event->getOrder();
        $orderProduct = $order->product;
        $dbProduct = Product::where('id', $orderProduct->id)
            ->where('store_id', $orderProduct->store['id'])
            ->first();
        if (null === $dbProduct) {
           Log::info("Product {$orderProduct->id} from order {$order->id} does not exists in database");
        } else {
            $dbProduct->updatePurchaseCounter($order->quantity);
            $dbProduct->refresh();
        }
    }
}