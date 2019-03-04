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
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductReviewRepository
 * @package App\Modules\Reviews\Repositories
 */
class ProductReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    /**
     * @return string
     */
    public function model() : string
    {
        return ProductReview::class;
    }

    /**
     * @param int $productId
     * @param int $offset
     * @return Collection|null
     */
    public function getActiveReviewsByOwnerId(int $productId, int $offset) : ?Collection
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

    /**
     * @param int $productId
     * @param int $offset
     * @return Collection|null
     */
    public function getActiveReviewsByOwnerIdPaginated(int $productId) : ?LengthAwarePaginator
    {
        $product = Product::find($productId);
        if (null === $product) {
            return null;
        }

        return $product->reviews()->active()
            ->latest()
            ->paginate(config('wish.store.pagination'));
    }

    /**
     * @param int $productId
     * @param int $offset
     * @return Collection|null
     */
    public function getInactiveReviewsByOwnerId(int $productId, int $offset) : ?Collection
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

    /**
     * @param ProductReview $review
     */
    public function activateReview(ProductReview $review) : void
    {
        $review->status = ReviewStatusEnum::ACTIVE;
        $review->save();
    }

    /**
     * @param ProductReview $review
     */
    public function deactivateReview(ProductReview $review) : void
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
        $review = new ProductReview();
        $review->order_id = $order->id;
        $review->customer_id = $order->customer_id;
        $review->product_id = $order->product->id;
        $review->rating = $rating;
        $review->comment = $comment;
        $review->save();
    }

    public function getReview(int $id)
    {
        return ProductReview::find($id);
    }
}
