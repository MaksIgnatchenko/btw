<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 13.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\SalesAnalyticsService\Implemetations;

use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Users\Admin\Services\SalesAnalyticsService\Interfaces\SalesAnalyticsInterface;

abstract class AbstractSalesAnalyticsService implements SalesAnalyticsInterface
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

    /**
     * @param int|null $year
     * @return array
     */
    public function getMonthlySalesAnalytics(?int $year = null) : array
    {
        return $this->orderRepository->getMonthlySalesAnalytics($this->getCountry(), $year);
    }

    /**
     * @return float
     */
    public function getTotalIncome() : float
    {
        return $this->orderRepository->getTotalIncome($this->getCountry());
    }

    /**
     * @return int
     */
    public function getAllOrdersCount(): int
    {
        return $this->orderRepository->getAllCount($this->getCountry());
    }


}