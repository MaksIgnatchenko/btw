<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 13.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\SalesAnalyticsService\Interfaces;

interface SalesAnalyticsInterface
{
    /**
     * @return array
     */
    public function getStatesStatistic() : array;

    /**
     * @param int|null $year
     * @return array
     */
    public function getMonthlySalesAnalytics(?int $year = null) : array;

    /**
     * @return int
     */
    public function getAllOrdersCount() : int;

    /**
     * @return float
     */
    public function getTotalIncome() : float;
}