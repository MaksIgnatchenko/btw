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

/**
 * Class MerchantReviewRepository
 * @package App\Modules\Reviews\Repositories
 */
class MerchantReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    /**
     * @return string
     */
    public function model() : string
    {
        return MerchantReview::class;
    }

    /**
     * @param int $merchantId
     * @param int $offset
     * @return Collection|null
     */
    public function getActiveReviewsByOwnerId(int $merchantId, int $offset) : ?Collection
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

    /**
     * @param int $merchantId
     * @param int $offset
     * @return Collection|null
     */
    public function getInactiveReviewsByOwnerId(int  $merchantId, int $offset) : ?Collection
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

    /**
     * @param MerchantReview $review
     */
    public function activateReview(MerchantReview $review) : void
    {
        $review->status = ReviewStatusEnum::ACTIVE;
        $review->save();
    }

    /**
     * @param MerchantReview $review
     */
    public function deactivateReview(MerchantReview $review) : void
    {
        $review->status = ReviewStatusEnum::INACTIVE;
        $review->save();
    }

    /**
     * @param Order $order
     * @param int $rating
     * @param string|null $comment
     */
    public function createReview(Order $order, int $rating, string $comment = null) : void
    {
        $review = new MerchantReview();
        $review->order_id = $order->id;
        $review->customer_id = $order->customer_id;
        $review->merchant_id = $order->merchant_id;
        $review->rating = $rating;
        $review->comment = $comment;
        $review->save();
    }

    public function getReview(int $id)
    {
        return MerchantReview::find($id);
    }
}
