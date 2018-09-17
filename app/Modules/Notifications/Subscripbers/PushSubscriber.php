<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.02.2018
 */

namespace App\Modules\Notifications\Subscribers;

use App\Modules\Bidding\Events\AddToWishListEvent;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Notifications\Jobs\SendAndroidPushJob;
use App\Modules\Notifications\Jobs\SendIosPushJob;
use App\Modules\Products\Enums\TransactionStatusEnum;
use App\Modules\Products\Events\AddProductEvent;
use App\Modules\Products\Events\TransactionCompletedEvent;
use App\Modules\Products\Models\Product;
use App\Modules\Review\Events\MerchantReviewUpdatedEvent;
use App\Modules\Review\Events\ProductReviewUpdatedEvent;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Enums\DeviceTypeEnum;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PushSubscriber extends MessageSubscriber
{
    /** @var CategoryRepository $categoryRepository */
    protected $categoryRepository;

    /**
     * NotificationSubscriber constructor.
     */
    public function __construct()
    {
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
            $product = app(Product::class);
            $product->fill((array)$cart->product);
            // TODO check if push enabled!!

            $devices[] = $product->user->device;
            $title = 'New transaction';
            $message = $this->getTransactionCompletedMessage($product, $cart->source);

            $this->sendNotifications($devices, $title, $message);
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
//        /** @var Merchant $merchant */
//        $merchant = $user->merchant;
//
//        if (!$merchant->checkReviewPushEnabled()) {
//            return;
//        }
//
//        $devices[] = $user->device;
//        $title = 'Product review';
//        $message = 'You have new product review!';
//
//        $this->sendNotifications($devices, $title, $message);
//    }
//
//    /**
//     * @param MerchantReviewUpdatedEvent $event
//     */
//    public function merchantReview(MerchantReviewUpdatedEvent $event): void
//    {
//        $review = $event->getMerchantReview();
//        if (ReviewStatusEnum::ACTIVE !== $review->status) {
//            return;
//        }
//
//        /** @var Merchant $merchant */
//        $merchant = $review->merchant;
//        /** @var User $user */
//        $user = $merchant->user;
//
//        if (!$merchant->checkReviewPushEnabled()) {
//            return;
//        }
//
//        $devices[] = $user->device;
//        $title = 'Merchant review';
//        $message = 'You have review!';
//
//        $this->sendNotifications($devices, $title, $message);
//    }

    /**
     * @param AddToWishListEvent $event
     */
    public function addToWishList(AddToWishListEvent $event): void
    {
        $wish = $event->getWish();

        $categoryId = $wish->product->category_id;

        $merchants = $this->categoryRepository->find($categoryId)->merchantsWhereEnabledWishList;
        if ($merchants->isEmpty()) {
            return;
        }

        $devices = $merchants->pluck('user.device');
        $title = 'New Wish List request';
        $message = 'Wow! Some one just added an item from your chosen categories to their WishList. You can find more details at the Bids page.';

        $this->sendNotifications($devices, $title, $message);
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

        $devices = [];

        foreach ($deliveryAddresses as $deliveryAddress) {
            /** @var Customer $customer */
            $customer = $deliveryAddress->customer;
            if (!$customer->checkNewDealsPushEnabled()) {
                continue;
            }

            $devices[] = $customer->user->device;
        }

        $title = 'New posted deal';
        $message = "There is a new deal in the {$category->name} category. Hurry up to check it out!";

        $this->sendNotifications($devices, $title, $message);
    }


    /**
     * @param array|Collection $devices
     * @param string $title
     * @param string $message
     */
    protected function sendNotifications($devices, string $title, string $message): void
    {
        $iosTokens = [];
        $androidTokens = [];
        foreach ($devices as $device) {
            if ($device->device_type === DeviceTypeEnum::IOS) {
                $iosTokens[] = $device->push_token;
                continue;
            }

            $androidTokens[] = $device->push_token;
        }

        dispatch(new SendIosPushJob($iosTokens, $title, $message));
        dispatch(new SendAndroidPushJob($androidTokens, $title, $message));
    }
}
