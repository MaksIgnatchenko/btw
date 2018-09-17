<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.01.2018
 */

namespace App\Modules\Orders\Subscribers;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        /** @var User $user */
        $user = Auth::user();
        /** @var Customer $customer */
        $customer = $user->customer;
        $transaction = $event->getTransaction();
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        /** @var UserRepository $userRepository */
        $userRepository = app(UserRepository::class);

        if (!$event->getResult()->success) {
            return;
        }

        $orders = [];
        $carts = json_decode($transaction->cart);
        foreach ($carts as $cart) {
            $product = $cart->product;
            /** @var Order $order */
            $order = app(Order::class);

            $user = $userRepository->find($cart->product->user_id);

            $orders[] = $order->fill([
                'transaction_id' => $transaction->id,
                'customer_id'    => $customer->id,
                'merchant_id'    => $user->merchant->id,
                'delivery_option' => $cart->delivery_option,

                'product'  => json_encode($product),
                'quantity' => $cart->quantity,
                'qr_code'  => Str::random(self::QR_CODE_LENGTH),
                'status'   => OrderStatusEnum::PENDING,

                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ])->toArray();
        }

        $orderRepository->saveMany($orders);
    }
}
