<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.02.2018
 */

namespace App\Modules\Products\Enums;

class CartSourceEnum
{
    public const PRODUCT = 'product';
    public const BID = 'bid';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::PRODUCT,
            self::BID,
        ];
    }
}
