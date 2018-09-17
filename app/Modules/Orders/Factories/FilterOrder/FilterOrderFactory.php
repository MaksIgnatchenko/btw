<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Factories\FilterOrder;

use App\Modules\Orders\Enums\OrderFilterEnum;
use App\Modules\Orders\Exceptions\WrongFilterException;
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
    public function get(string $filter): OrdersInterface
    {
        switch ($filter) {
            case OrderFilterEnum::UNREDEEMED:
                return app(UnredeemedOrders::class);
            case OrderFilterEnum::REDEEMED:
                return app(RedeemedOrders::class);
            case OrderFilterEnum::REFUNDED:
                return app(RefundedOrders::class);
            case OrderFilterEnum::RETURNED:
                return app(ReturnedOrders::class);
            case OrderFilterEnum::ALL:
                return app(AllOrders::class);

            default:
                throw new WrongFilterException("No such filter - {$filter}");
        }
    }
}
