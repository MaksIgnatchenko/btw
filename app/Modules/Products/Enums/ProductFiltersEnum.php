<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 10.10.2018
 */

namespace App\Modules\Products\Enums;

use App\Modules\Products\Filter\Particular\FromCreationDaysFilter;
use App\Modules\Products\Filters\Particular\PriceGtFilter;
use App\Modules\Products\Filters\Particular\PriceLtFilter;

class ProductFiltersEnum
{
    public const PRICE_LESS_THEN = 'fplt';
    public const PRICE_GREATER_THEN = 'fpgt';
    public const DAYS_FROM_CREATION = 'ffcd';

    /**
     * @return array
     */
    public static function toClassArray(): array
    {
        return [
            self::PRICE_LESS_THEN => PriceLtFilter::class,
            self::PRICE_GREATER_THEN => PriceGtFilter::class,
            self::DAYS_FROM_CREATION => FromCreationDaysFilter::class,
        ];
    }

    public static function toArray(): array
    {
        return [
            self::PRICE_LESS_THEN ,
            self::PRICE_GREATER_THEN,
            self::DAYS_FROM_CREATION,
        ];
    }

    /**
     * @return array
     */
    public static function rules(): array
    {
        return [
            self::PRICE_LESS_THEN => 'sometimes|numeric',
            self::PRICE_GREATER_THEN => 'sometimes|numeric',
            self::DAYS_FROM_CREATION => 'sometimes|integer',
        ];
    }
}