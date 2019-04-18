<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 9.10.2018
 */

namespace App\Modules\Products\Enums;

class ProductOrdersEnum
{
    public const PRICE_LOWEST = 'lowest_price';
    public const PRICE_HIGHEST = 'highest_price';
    public const RATING_LOWEST = 'lowest_rating';
    public const RATING_HIGHEST = 'highest_rating';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::PRICE_LOWEST,
            self::PRICE_HIGHEST,
            self::RATING_LOWEST,
            self::RATING_HIGHEST,
        ];
    }
}