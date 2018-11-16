<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Enums;

class OrderStatusEnum
{
    public const IN_PROCESS = 'in_process';
    public const SHIPPED = 'shipped';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::IN_PROCESS   => 'In Process',
            self::SHIPPED => 'Shipped',
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return join(',', array_keys(self::toArray()));
    }
}
