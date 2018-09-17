<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Enums;

class CustomerFilterEnum
{
    public const ALL = 'all';
    public const MY = 'my';
    public const BID_RESULT = 'bid-result';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::ALL, self::MY, self::BID_RESULT];
    }
}
