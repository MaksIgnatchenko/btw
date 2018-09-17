<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Factories\FilterOrder;

use App\Modules\Orders\Factories\OrdersInterface;
use Illuminate\Support\Collection;

class RefundedOrders extends AbstractOrders implements OrdersInterface
{
    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getOrders(int $customerId, int $offset): Collection
    {
        return $this->orderRepository->getRefunded($customerId, $offset);
    }
}
