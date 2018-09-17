<?php

namespace App\Modules\Review\Repositories;

use App\Modules\Review\Models\MerchantReview;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use InfyOm\Generator\Common\BaseRepository;

class MerchantReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'status',
        'created_at',
    ];

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return MerchantReview::class;
    }

    /**
     * @param MerchantReview $review
     */
    public function save(MerchantReview $review): void
    {
        $review->save();
    }

    /**
     * @param int $merchantId
     *
     * @return float
     */
    public function getAvgRatingByMerchantId(int $merchantId): ?float
    {
        return MerchantReview::query()
            ->where('merchant_id', $merchantId)
            ->where('status', ReviewStatusEnum::ACTIVE)
            ->avg('rate');
    }
}
