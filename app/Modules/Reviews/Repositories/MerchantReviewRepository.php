<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Repositories;

use App\Modules\Orders\Models\Order;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Reviews\Models\MerchantReview;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class MerchantReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model() : string
    {
        return MerchantReview::class;
    }

    public function getActiveReviews(int $merchantId, int $offset) : ?Collection
    {
        $merchant = Merchant::find($merchantId);

        if (null === $merchant) {
            return null;
        }

        return $merchant->reviews()->active()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function getInactiveReviews(int  $merchantId, int $offset) : ?Collection
    {
        $merchant = Merchant::find($merchantId);

        if (null === $merchant) {
            return null;
        }

        return $merchant->reviews()->inactive()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function activateReview(MerchantReview $review) : void
    {
        $review->status = ReviewStatusEnum::ACTIVE;
        $review->save();
    }

    public function deactivateReview(MerchantReview $review) : void
    {
        $review->status = ReviewStatusEnum::INACTIVE;
        $review->save();
    }

    public function createReview(Order $order, int $rating, string $comment = null) : MerchantReview
    {
        $review = new MerchantReview();
        $review->order_id = $order->id;
        $review->customer_id = $order->customer_id;
        $review->merchant_id = $order->merchant_id;
        $review->rating = $rating;
        $review->comment = $comment;
        $review->save();

        return $review;
    }
}
