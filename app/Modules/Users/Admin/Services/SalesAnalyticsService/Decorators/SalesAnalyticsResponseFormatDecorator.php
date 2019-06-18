<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 18.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\SalesAnalyticsService\Decorators;

use App\Modules\Users\Admin\Services\SalesAnalyticsService\Interfaces\SalesAnalyticsInterface;

class SalesAnalyticsResponseFormatDecorator implements SalesAnalyticsInterface
{
    /**
     * @var SalesAnalyticsInterface
     */
    protected $salesAnalyticsService;

    /**
     * SalesAnalyticsResponseFormatDecorator constructor.
     * @param SalesAnalyticsInterface $salesAnalyticsService
     */
    public function __construct(SalesAnalyticsInterface $salesAnalyticsService)
    {
        $this->salesAnalyticsService = $salesAnalyticsService;
    }

    /**
     * @return int
     */
    public function getAllOrdersCount(): int
    {
        return $this->salesAnalyticsService->getAllOrdersCount();
    }

    /**
     * @return float
     */
    public function getTotalIncome(): float
    {
        return $this->salesAnalyticsService->getTotalIncome();
    }

    /**
     * @param int|null $year
     * @return array
     */
    public function getMonthlySalesAnalytics(?int $year = null): array
    {
        $data = $this->salesAnalyticsService->getMonthlySalesAnalytics($year);
        $formattedData = [
            'months' => ['month'],
            'orders' => ['orders'],
            'customers' => ['customers']
        ];

        for ($monthNumber = 1; $monthNumber <= 12; $monthNumber++) {
            $monthData = $this->getDataForMonth($data, $monthNumber);
            $formattedData['months'][] = $monthData['month'];
            $formattedData['orders'][] = $monthData['orders'];
            $formattedData['customers'][] = $monthData['customers'];
        }
        return $formattedData;
    }

    /**
     * @return array
     */
    public function getStatesStatistic(): array
    {
        return $this->salesAnalyticsService->getStatesStatistic();
    }

    /**
     * @param array $data
     * @param int $monthNumber
     * @return array
     */
    protected function getDataForMonth(array $data, int $monthNumber) : array
    {
        foreach ($data as $monthData) {
            if ($monthData['month'] === $monthNumber) {
                return $monthData;
            }
        }
        return [
            'month' => $monthNumber,
            'orders' => 0,
            'customers' => 0,
        ];
    }



}