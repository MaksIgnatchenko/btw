<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-21
 * Time: 17:30
 */

namespace App\Modules\Orders\Shipping;

use App\Modules\Orders\Enums\OrderStatusEnum;

class AfterShippingHelper
{
    /**
     * @param string $status
     * @return string
     * @throws ShippingException
     */
    public static function getOrderStatus(string $status): string
    {
        switch ($status) {
            case ShippingStatusEnum::DELIVERED:
                return OrderStatusEnum::PICKED_UP;
            case ShippingStatusEnum::OUT_FOR_DELIVERY:
                return OrderStatusEnum::DELIVERED;
            case ShippingStatusEnum::PENDING:
                return OrderStatusEnum::PENDING;

            default:
                throw new ShippingException("Wrong aftershipping status - {$status}");
        }

    }
}