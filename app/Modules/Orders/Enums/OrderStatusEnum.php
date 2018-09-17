<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Enums;

class OrderStatusEnum
{
    public const PENDING = 'pending';
    public const PICKED_UP = 'picked_up';
    public const RETURNED = '__returned';
    public const REFUNDED = '_refunded';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::PENDING   => 'Pending pickup',
            self::PICKED_UP => 'Picked up',
            self::REFUNDED  => 'Refunded',
            self::RETURNED  => 'Returned',
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::PENDING . ',' . self::PICKED_UP . ',' . self::REFUNDED . ',' . self::RETURNED;
    }
}
