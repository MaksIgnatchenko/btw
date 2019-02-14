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

class MerchantReviewRepository extends BaseRepository
{
    public function model() : string
    {
        return MerchantReview::class;
    }

    public function getActiveReviews(Merchant $merchant, int $offset) : Collection
    {
        return $merchant->reviews()->active()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function getInactiveReviews(Merchant $merchant, int $offset) : Collection
    {
        return $merchant->reviews()->inactive()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function activateReview(MerchantReview $review) : bool
    {
        $review->status = ReviewStatusEnum::ACTIVE;
        $review->save();
        
        return true;
    }

    public function deactivateReview(MerchantReview $review) : bool
    {
        $review->status = ReviewStatusEnum::INACTIVE;
        $review->save();

        return true;
    }

    public function createReview(Order $order, $rating, $comment = null) : bool
    {
        $review = new MerchantReview();
        $review->order_id = $order->id;
        $review->customer_id = $order->customer_id;
        $review->merchant_id = $order->merchant_id;
        $review->rating = $rating;
        $review->comment = $comment;
        $review->save();

        return true;
    }
}
