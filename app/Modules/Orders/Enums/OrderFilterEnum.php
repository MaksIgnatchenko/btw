<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Enums;

class OrderFilterEnum
{
    public const IN_PROCESS = 'in_process';
    public const SHIPPED = 'shipped';
    public const DELIVERED = 'delivered';
    public const PICKED_UP = 'picked_up';
    public const ALL = 'all';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::IN_PROCESS,
            self::SHIPPED,
            self::DELIVERED,
            self::PICKED_UP,
            self::ALL,
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::IN_PROCESS . ',' . self::SHIPPED . ',' . self::DELIVERED . ',' .  self::PICKED_UP . ',' . self::ALL;
    }
}
