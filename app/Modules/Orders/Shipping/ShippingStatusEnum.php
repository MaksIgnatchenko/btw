<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-21
 * Time: 13:53
 */

namespace App\Modules\Orders\Shipping;

class ShippingStatusEnum
{
    public const PENDING = 'Pending';
    public const DELIVERED = 'Delivered';
    public const OUT_FOR_DELIVERY = 'OutForDelivery';
    public const IN_TRANSIT = 'InTransit';
}
