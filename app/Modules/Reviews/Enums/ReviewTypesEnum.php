<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 15.02.2019
 */

namespace App\Modules\Reviews\Enums;

class ReviewTypesEnum
{
    public const MERCHANT = 'merchant';
    public const PRODUCT = 'product';


    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::MERCHANT => 'Merchant',
            self::PRODUCT => 'Product',
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return implode(',', array_keys(self::toArray()));
    }
}
