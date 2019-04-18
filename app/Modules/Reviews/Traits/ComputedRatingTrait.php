<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */
namespace App\Modules\Reviews\Traits;

/**
 * Trait ComputedRatingTrait
 * @package App\Modules\Reviews\Traits
 */
trait ComputedRatingTrait
{
    /**
     * @return float|int
     */
    public function getRatingAttribute()
    {
        if (isset($this->attributes['rating'])) {
           return round($this->attributes['rating'], 1);
        }
        $merchantReviews = $this->reviews()->active()->get(['rating']);

        if (1 > $merchantReviews->count()) {
            return 0;
        }

        $rating = $merchantReviews->reduce(function ($collector, $item) {
                return $collector + $item->rating;
        }, 0) / $merchantReviews->count();

        return round($rating, 1);
    }

    /**
     * @return integer
     */
    public function getReviewCountAttribute()
    {
        return $this->reviews()->active()->count();
    }
}
