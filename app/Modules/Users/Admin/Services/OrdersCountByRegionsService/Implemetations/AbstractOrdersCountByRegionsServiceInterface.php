<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 13.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Implemetations;

use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Interfaces\OrdersCountByRegionsServiceInterface;

abstract class AbstractOrdersCountByRegionsServiceInterface implements OrdersCountByRegionsServiceInterface
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * AbstractGeographicalAnalyzerOfOrdersService constructor.
     */
    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
    }

    /**
     * @return string
     */
    abstract protected function getCountry() : string;

    /**
     * @return array
     */
    public function getStatesStatistic(): array
    {
        return $this->orderRepository
            ->getOrdersCountByStatesForCountry($this->getCountry());
    }
}