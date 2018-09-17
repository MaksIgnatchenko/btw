<?php

namespace App\Modules\Review\Repositories;

use App\Modules\Review\Models\ProductReview;
use InfyOm\Generator\Common\BaseRepository;

class ProductReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'status',
    ];

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return ProductReview::class;
    }

    /**
     * @param ProductReview $review
     */
    public function save(ProductReview $review)
    {
        $review->save();
    }
}
