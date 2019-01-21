<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Enums;

class OrderStatusEnum
{
    public const IN_PROCESS = 'in_process';
    public const SHIPPED = 'shipped';
    public const DELIVERED = 'delivered';
    public const PICKED_UP = 'picked_up';
    public const CLOSED = 'closed';

    public const PENDING = 'pending';


    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::IN_PROCESS => 'In process',
            self::SHIPPED => 'Shipped',
            self::DELIVERED => 'Delivered',
            self::PICKED_UP => 'Picked up',
            self::CLOSED => 'Closed',
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
