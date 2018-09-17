<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.03.2018
 */

namespace App\Modules\Products\Enums;

class CartDeliveryOptionEnum
{
    public const LOCAL_DELIVERY = 'local_delivery';
    public const STORE_DELIVERY = 'store_delivery';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::LOCAL_DELIVERY, self::STORE_DELIVERY];
    }
}
