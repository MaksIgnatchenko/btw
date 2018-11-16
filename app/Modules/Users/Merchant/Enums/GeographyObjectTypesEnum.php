<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Users\Merchant\Enums;

use App\Modules\Users\Merchant\Models\Geography\GeographyCity;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;

class GeographyObjectTypesEnum
{
    public const COUNTRY = 'country';
    public const STATE = 'state';
    public const CITY = 'city';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::COUNTRY,
            self::STATE,
            self::CITY,
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return implode(',', self::toArray());
    }

    /**
     * @return array
     */
    public static function relatedModelsArray()
    {
        return [
            self::COUNTRY => GeographyCountry::class,
            self::STATE => GeographyState::class,
            self::CITY => GeographyCity::class,
        ];
    }
}