<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Factories;

use App\Modules\Orders\Enums\OrderFilterEnum;
use App\Modules\Orders\Exceptions\WrongFilterException;
use App\Modules\Orders\Factories\FilterOrder\AllOrders;
use App\Modules\Orders\Factories\FilterOrder\DeliveredOrders;
use App\Modules\Orders\Factories\FilterOrder\InProcessOrders;
use App\Modules\Orders\Factories\FilterOrder\PickedUpOrders;
use App\Modules\Orders\Factories\FilterOrder\ShippedOrders;
use App\Modules\Orders\Factories\FiltersFactoryInterface;
use App\Modules\Orders\Factories\OrdersInterface;

class FilterOrderFactory implements FiltersFactoryInterface
{
    /**
     * @param string $filter
     *
     * @return OrdersInterface
     * @throws WrongFilterException
     */
    public static function get(string $filter): OrdersInterface
    {
        switch ($filter) {
            case OrderFilterEnum::DELIVERED:
                return app(DeliveredOrders::class);
            case OrderFilterEnum::PICKED_UP:
                return app(PickedUpOrders::class);
            case OrderFilterEnum::IN_PROCESS:
                return app(InProcessOrders::class);
            case OrderFilterEnum::SHIPPED:
                return app(ShippedOrders::class);
            case OrderFilterEnum::ALL:
                return app(AllOrders::class);

            default:
                throw new WrongFilterException("No such filter - {$filter}");
        }
    }
}
