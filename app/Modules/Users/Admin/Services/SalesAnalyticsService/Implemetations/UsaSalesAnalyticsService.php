<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 13.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\SalesAnalyticsService\Implemetations;

class UsaSalesAnalyticsService extends AbstractSalesAnalyticsService
{
    /**
     * @return string
     */
    protected function getCountry(): string
    {
        return 'USA';
    }

}