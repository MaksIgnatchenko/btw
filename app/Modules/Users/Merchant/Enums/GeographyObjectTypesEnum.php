<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Users\Merchant\Enums;

class GeographyObjectTypesEnum
{
    public const COUNTRY = 'country';
    public const STATE = 'state';
    public const CITY = 'city';

    public static function toArray()
    {
        return [
            self::COUNTRY,
            self::STATE,
            self::CITY,
        ];
    }

    public static function toString()
    {
        return implode(',', self::toArray());
    }
}