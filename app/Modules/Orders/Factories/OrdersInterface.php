<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */

namespace App\Modules\Orders\Factories;

use Illuminate\Support\Collection;

interface OrdersInterface
{
    /**
     * @param int $customerId
     *
     * @param int $offset
     *
     * @return Collection
     */
    public function getOrders(int $customerId, int $offset): Collection;
}