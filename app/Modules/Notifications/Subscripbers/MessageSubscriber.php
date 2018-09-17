<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.02.2018
 */

namespace App\Modules\Notifications\Subscribers;

use App\Modules\Bidding\Events\AddToWishListEvent;
use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Events\AddProductEvent;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Models\Product;
use App\Modules\Review\Events\MerchantReviewUpdatedEvent;
use App\Modules\Review\Events\ProductReviewUpdatedEvent;

abstract class MessageSubscriber
{
    protected const DEFAULT_RADIUS = 10;

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events): void
    {
//        $events->listen(ProductReviewUpdatedEvent::class, static::class . '@productReview');
//        $events->listen(MerchantReviewUpdatedEvent::class, static::class . '@merchantReview');
        $events->listen(TransactionCompletedEvent::class, static::class . '@transactionCompleted');
        $events->listen(AddToWishListEvent::class, static::class . '@addToWishList');
        $events->listen(AddProductEvent::class, static::class . '@addProduct');
    }

    /**
     * @param TransactionCompletedEvent $event
     */
    abstract public function transactionCompleted(TransactionCompletedEvent $event): void;

//    /**
//     * @param ProductReviewUpdatedEvent $event
//     */
//    abstract public function productReview(ProductReviewUpdatedEvent $event): void;
//
//    /**
//     * @param MerchantReviewUpdatedEvent $event
//     */
//    abstract public function merchantReview(MerchantReviewUpdatedEvent $event): void;

    /**
     * @param AddToWishListEvent $event
     */
    abstract public function addToWishList(AddToWishListEvent $event): void;

    /**
     * @param AddProductEvent $event
     */
    abstract public function addProduct(AddProductEvent $event): void;

    /**
     * @param Product $product
     * @param string $source
     *
     * @return string
     */
    protected function getTransactionCompletedMessage(Product $product, string $source): string
    {
        $productName = $product->name;

        if (CartSourceEnum::BID === $source) {
            return "Congratulations! Your item {$productName} was purchased. Please check the Homepage to get more details.";
        }

        return "Congratulations! Your bid {$productName} was chosen by a customer. Please check the Transaction to get more details.";
    }
}
