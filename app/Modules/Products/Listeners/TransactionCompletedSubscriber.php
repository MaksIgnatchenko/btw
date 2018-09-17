<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 10.01.2018
 */

namespace App\Modules\Products\Listeners;

use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Enums\TransactionStatusEnum;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Repositories\TransactionRepository;

class TransactionCompletedSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
        $events->listen(TransactionCompletedEvent::class, self::class . '@clearCart');
        $events->listen(TransactionCompletedEvent::class, self::class . '@setTransactionStatus');
        $events->listen(TransactionCompletedEvent::class, self::class . '@increaseProductsCounter');
        $events->listen(TransactionCompletedEvent::class, self::class . '@decreaseProductQuantity');
    }

    /**
     * @param TransactionCompletedEvent $event
     */
    public function clearCart(TransactionCompletedEvent $event): void
    {
        $transaction = $event->getTransaction();

        if (!$event->getResult()->success) {
            return;
        }

        $customerId = $transaction->customer_id;
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        $cartRepository->deleteWhere(['customer_id' => $customerId]);
    }

    public function setTransactionStatus(TransactionCompletedEvent $event): void
    {
        $transaction = $event->getTransaction();

        /** @var TransactionRepository $transactionRepository */
        $transactionRepository = app(TransactionRepository::class);

        $transaction->status = TransactionStatusEnum::FAIL;
        if ($event->getResult()->success) {
            $transaction->status = TransactionStatusEnum::SUCCESS;
        }

        $transactionRepository->save($transaction);
    }

    /**
     * @param TransactionCompletedEvent $event
     */
    public function increaseProductsCounter(TransactionCompletedEvent $event): void
    {
        $transaction = $event->getTransaction();

        if (!$event->getResult()->success) {
            return;
        }

        $orders = collect(json_decode($transaction->cart));
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);

        foreach ($orders as $order) {
            $productRepository->incrementCounter($order->product_id, $order->quantity);
        }
    }

    /**
     * @param TransactionCompletedEvent $event
     */
    public function decreaseProductQuantity(TransactionCompletedEvent $event): void
    {
        $transaction = $event->getTransaction();

        if (!$event->getResult()->success) {
            return;
        }

        $orders = collect(json_decode($transaction->cart));
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);

        foreach ($orders as $order) {
            if (CartSourceEnum::PRODUCT !== $order->source) {
                continue;
            }
            
            /** @var Product $product */
            $product = $productRepository->find($order->product_id);
            $product->decreaseQuantity($order->quantity);
            $productRepository->save($product);
        }
    }
}
