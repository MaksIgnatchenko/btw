<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Enums;

class OrderFilterEnum
{
    public const REDEEMED = 'redeemed';
    public const UNREDEEMED = 'unredeemed';
    public const REFUNDED = 'refunded';
    public const RETURNED = 'returned';
    public const ALL = 'all';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::REDEEMED,
            self::UNREDEEMED,
            self::REFUNDED,
            self::RETURNED,
            self::ALL,
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::REDEEMED . ',' . self::UNREDEEMED . ',' . self::REFUNDED . ',' . self::RETURNED . ',' . self::ALL;
    }
}
