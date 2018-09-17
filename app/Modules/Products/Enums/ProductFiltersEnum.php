<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.12.2017
 */

namespace App\Modules\Products\Enums;

class ProductFiltersEnum
{
    public const OUTSTANDING_OFFERS = 'outstanding-offers';
    public const EXPIRED_OFF = 'expired-off';

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::OUTSTANDING_OFFERS
            . ','
            . self::EXPIRED_OFF;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::OUTSTANDING_OFFERS => 'Outstanding offers',
            self::EXPIRED_OFF        => 'Expired off',
        ];
    }
}
