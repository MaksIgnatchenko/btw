<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Factories\FilterMerchantOrder;

use App\Modules\Order\Enums\OrderMerchantFilterEnum;
use App\Modules\Orders\Exceptions\WrongFilterException;
use App\Modules\Orders\Factories\FiltersFactoryInterface;
use App\Modules\Orders\Factories\OrdersInterface;

class FilterMerchantOrderFactory implements FiltersFactoryInterface
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
            case OrderMerchantFilterEnum::COMPLETED_TRANSACTIONS:
                return app(CompletedTransactions::class);
            case OrderMerchantFilterEnum::PENDING_PAYOUT:
                return app(PendingPayouts::class);
            case OrderMerchantFilterEnum::PENDING_REDEMPTION:
                return app(PendingRedemption::class);
            case OrderMerchantFilterEnum::RETURNED:
                return app(Returned::class);

            default:
                throw new WrongFilterException("No such filter - {$filter}");
        }
    }
}
