<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */
namespace App\Modules\Reviews\Traits;

trait ComputedRatingTrait
{
    public function getRatingAttribute()
    {
        $merchantReviews = $this->reviews()->active()->get(['rating']);

        if (1 > $merchantReviews->count()) {
            return 0;
        }

        return $merchantReviews->reduce(function ($collector, $item) {
                return $collector + $item->rating;
        }, 0) / $merchantReviews->count();
    }
}