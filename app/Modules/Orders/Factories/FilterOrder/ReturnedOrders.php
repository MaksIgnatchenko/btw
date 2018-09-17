<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 19.03.2018
 */

namespace App\Modules\Orders\Factories\FilterOrder;

use Illuminate\Support\Collection;
use App\Modules\Orders\Factories\OrdersInterface;

class ReturnedOrders extends AbstractOrders implements OrdersInterface
{
    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getOrders(int $customerId, int $offset): Collection
    {
        return $this->orderRepository->getReturned($customerId, $offset);
    }
}
