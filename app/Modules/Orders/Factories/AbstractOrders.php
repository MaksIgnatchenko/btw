<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Factories\FilterOrder;

use App\Modules\Orders\Repositories\OrderRepository;

abstract class AbstractOrders
{
    /** @var OrderRepository */
    protected $orderRepository;

    /**
     * AbstractGetOrders constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
}
