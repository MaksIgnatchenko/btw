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

class ProductReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model() : string
    {
        return ProductReview::class;
    }

    public function getActiveReviews(int $productId, int $offset) : Collection
    {
        $product = Product::find($productId);

        if (null === $product) {
            return null;
        }

        return Product::find($productId)->reviews()->active()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function getInactiveReviews(int $productId, int $offset) : Collection
    {
        $product = Product::find($productId);

        if (null === $product) {
            return null;
        }

        return $product->reviews()->inactive()
            ->take(MerchantReview::PER_PAGE)
            ->skip($offset)
            ->get();
    }

    public function activateReview(ProductReview $review) : void
    {
        $review->status = ReviewStatusEnum::ACTIVE;
        $review->save();
    }

    public function deactivateReview(ProductReview $review) : void
    {
        $review->status = ReviewStatusEnum::INACTIVE;
        $review->save();
    }

    public function createReview(Order $order, int $rating, string $comment = null) : ProductReview
    {
        $review = new ProductReview();
        $review->order_id = $order->id;
        $review->customer_id = $order->customer_id;
        $review->product_id = $order->product->id;
        $review->rating = $rating;
        $review->comment = $comment;
        $review->save();

        return $review;
    }
}
