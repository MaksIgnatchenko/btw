<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */

namespace App\Modules\Orders\Factories\FilterMerchantOrder;

use App\Modules\Orders\Factories\FilterOrder\AbstractOrders;
use App\Modules\Orders\Factories\OrdersInterface;
use Illuminate\Support\Collection;

class CompletedTransactions extends AbstractOrders implements OrdersInterface
{
    /**
     * @param int $merchantId
     * @param int $offset
     *
     * @return Collection
     */
    public function getOrders(int $merchantId, int $offset): Collection
    {
        return $this->orderRepository->findCompletedTransactions($merchantId, $offset);
    }
}
