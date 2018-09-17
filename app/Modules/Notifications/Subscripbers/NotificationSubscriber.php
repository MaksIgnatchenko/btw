<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.02.2018
 */

namespace App\Modules\Notifications\Subscribers;

use App\Modules\Bidding\Events\AddToWishListEvent;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Notifications\Repositories\NotificationRepository;
use App\Modules\Products\Enums\TransactionStatusEnum;
use App\Modules\Products\Events\AddProductEvent;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Models\Product;
use App\Modules\Review\Events\MerchantReviewUpdatedEvent;
use App\Modules\Review\Events\ProductReviewUpdatedEvent;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Models\User;

class NotificationSubscriber extends MessageSubscriber
{
    /** @var NotificationRepository $notificationRepository */
    protected $notificationRepository;
    /** @var CategoryRepository $categoryRepository */
    protected $categoryRepository;

    /**
     * NotificationSubscriber constructor.
     */
    public function __construct()
    {
        $this->notificationRepository = app(NotificationRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * @param TransactionCompletedEvent $event
     */
    public function transactionCompleted(TransactionCompletedEvent $event): void
    {
        $transaction = $event->getTransaction();
        if (TransactionStatusEnum::SUCCESS !== $transaction->status) {
            return;
        }

        $carts = \GuzzleHttp\json_decode($transaction->cart);

        foreach ($carts as $cart) {
            /** @var Merchant $merchant */
            $product = app(Product::class);
            $product->fill((array)$cart->product);
            $merchant = $product->user->merchant;
            if (!$merchant->checkTransactionPushEnabled()) {
                return;
            }

            $product = app(Product::class);
            $product->fill((array)$cart->product);

            $message = $this->getTransactionCompletedMessage($product, $cart->source);
            $title = 'New transaction';

            $this->sendNotification($product->user_id, $title, $message);
        }
    }

//    /**
//     * @param ProductReviewUpdatedEvent $event
//     */
//    public function productReview(ProductReviewUpdatedEvent $event): void
//    {
//        $review = $event->getProductReview();
//        if (ReviewStatusEnum::ACTIVE !== $review->status) {
//            return;
//        }
//        /** @var User $user */
//        $user = $review->product->user;
//
//        $message = 'You have new product review!';
//        $title = 'Product review';
//
//        $this->sendNotification($user->id, $title, $message);
//    }

//    /**
//     * @param MerchantReviewUpdatedEvent $event
//     */
//    public function merchantReview(MerchantReviewUpdatedEvent $event): void
//    {
//        $review = $event->getMerchantReview();
//
//        /** @var Merchant $merchant */
//        $merchant = $review->merchant;
//        /** @var User $user */
//        $user = $merchant->user;
//
//        $message = 'You have review!';
//        $title = 'Merchant review';
//
//        $this->sendNotification($user->id, $title, $message);
//    }

    /**
     * @param AddToWishListEvent $event
     */
    public function addToWishList(AddToWishListEvent $event): void
    {
        $wish = $event->getWish();

        $categoryId = $wish->product->category_id;

        $category = $this->categoryRepository->find($categoryId);
        $userIds = $category->merchants->pluck('user_id')->toArray();

        $title = 'New Wish List request';
        $message = 'Wow! Some one just added an item from your chosen categories to their WishList. You can find more details at the Bids page.';

        $this->sendNotifications($userIds, $title, $message);
    }

    /**
     * @param AddProductEvent $event
     */
    public function addProduct(AddProductEvent $event): void
    {
        $product = $event->getProduct();
        $category = $product->category;
        $merchant = $product->user->merchant;
        $longitude = $merchant->longitude;
        $latitude = $merchant->latitude;

        $deliveryAddresses = $this->categoryRepository->findCustomersInRadius(
            $category->id,
            $longitude,
            $latitude,
            self::DEFAULT_RADIUS
        );

        $userIds = $deliveryAddresses->pluck('customer.user_id')->toArray();

        $title = 'New posted deal';
        $message = "There is a new deal in the {$category->name} category. Hurry up to check it out!";

        $this->sendNotifications($userIds, $title, $message);
    }

    /**
     * @param array $userIds
     * @param string $title
     * @param string $message
     */
    protected function sendNotifications(array $userIds, string $title, string $message): void
    {
        foreach ($userIds as $userId) {
            $this->sendNotification($userId, $title, $message);
        }
    }

    /**
     * @param int $userId
     * @param string $title
     * @param string $message
     */
    protected function sendNotification(int $userId, string $title, string $message): void
    {
        $notification = app(Notification::class);
        $notification->fill([
            'user_id' => $userId,
            'title'   => $title,
            'message' => $message,
            'is_read' => false,
        ]);

        $this->notificationRepository->save($notification);
    }
}
