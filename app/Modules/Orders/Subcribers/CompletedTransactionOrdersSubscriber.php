<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.01.2018
 */

namespace App\Modules\Orders\Subscribers;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CompletedTransactionOrdersSubscriber
{
    protected const QR_CODE_LENGTH = 64;

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(TransactionCompletedEvent::class, self::class . '@addOrders');
    }

    /**
     * @param TransactionCompletedEvent $event
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function addOrders(TransactionCompletedEvent $event): void
    {
        /** @var \App\Modules\Users\Customer\Models\Customer $customer */
        $customer = Auth::user();
        $transaction = $event->getTransaction();
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);

        if (!$event->getResult()->success) {
            return;
        }

        $orders = [];
        $carts = json_decode($transaction->cart);
        foreach ($carts as $cart) {
            /** @var Order $order */
            $order = app(Order::class);

            $product = $productRepository->find($cart->product_id);
            $merchant = $product->store->merchant;

            $orders[] = $order->fill([
                'transaction_id' => $transaction->id,
                'customer_id'    => $customer->id,
                'merchant_id'    => $merchant->id,

                'product'  => $product->toJson(),
                'quantity' => $cart->quantity,
                'status'   => OrderStatusEnum::IN_PROCESS,

                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ])->toArray();
        }

        $orderRepository->saveMany($orders);
    }
}
