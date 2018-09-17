<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Review\Events;

use App\Modules\Review\Models\ProductReview;

class ProductReviewUpdatedEvent
{
    /** @var ProductReview $merchantReview */
    protected $productReview;

    public function __construct(ProductReview $productReview)
    {
        $this->productReview = $productReview;
    }

    /**
     * @return ProductReview
     */
    public function getProductReview(): ProductReview
    {
        return $this->productReview;
    }
}
