<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Repositories;

use App\Modules\Orders\Models\Order;
use App\Modules\Products\Models\Product;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Reviews\Models\MerchantReview;
use App\Modules\Reviews\Models\ProductReview;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class ProductReviewRepository extends BaseRepository
{
    public function model() : string
    {
        return ProductReview::class;
    }

    public function getActiveReviews(Product $product, int $offset) : Collection
    {
        return $product->reviews()->active()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function getInactiveReviews(Product $product, int $offset) : Collection
    {
        return $product->reviews()->inactive()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function activateReview(ProductReview $review) : bool
    {
        $review->status = ReviewStatusEnum::ACTIVE;
        $review->save();
        
        return true;
    }

    public function deactivateReview(ProductReview $review) : bool
    {
        $review->status = ReviewStatusEnum::INACTIVE;
        $review->save();

        return true;
    }

    public function createReview(Order $order, $rating, $comment = null) : bool
    {
        $review = new ProductReview();
        $review->order_id = $order->id;
        $review->customer_id = $order->customer_id;
        $review->product_id = $order->product->id;
        $review->rating = $rating;
        $review->comment = $comment;
        $review->save();

        return true;
    }
}
