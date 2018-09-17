<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Enums;

class MerchantFilterEnum
{
    public const ALL = 'all';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::ALL];
    }
}
