<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 13.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Implemetations;

class UsaOrdersCountByRegionsService extends AbstractOrdersCountByRegionsServiceInterface
{
    /**
     * @return string
     */
    protected function getCountry(): string
    {
        return 'USA';
    }

}