<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 21.02.2018
 */

namespace App\Modules\WebOffers\Helpers;

class GeneratorHelper
{
    /**
     * @return float
     */
    public static function generateWebOfferRating(): float
    {
        $randomNumber = random_int(1, 100);

        if ($randomNumber <= 50) {
            return 5;
        }
        if ($randomNumber <= 80) {
            return 4.5;
        }

        return 4;
    }
}
