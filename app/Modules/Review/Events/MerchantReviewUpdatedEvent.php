<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Review\Events;

use App\Modules\Review\Models\MerchantReview;

class MerchantReviewUpdatedEvent
{
    /** @var MerchantReview $merchantReview */
    protected $merchantReview;

    public function __construct(MerchantReview $merchantReview)
    {
        $this->merchantReview = $merchantReview;
    }

    /**
     * @return MerchantReview
     */
    public function getMerchantReview(): MerchantReview
    {
        return $this->merchantReview;
    }
}
