<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 16.11.2018
 */

namespace App\Modules\Orders\Factories\FilterOrder;

use App\Modules\Orders\Factories\OrdersInterface;
use Illuminate\Support\Collection;

class ShippedOrders extends AbstractOrders implements OrdersInterface
{
    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getOrders(int $customerId, int $offset): Collection
    {
        return $this->orderRepository->getShipped($customerId, $offset);
    }
}
