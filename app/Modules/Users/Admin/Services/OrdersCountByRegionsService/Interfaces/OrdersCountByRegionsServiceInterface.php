<?php
/**
 * Created by Maksym Ignatchenko, Appus Studio LP on 13.06.19
 *
 */

namespace App\Modules\Users\Admin\Services\OrdersCountByRegionsService\Interfaces;

interface OrdersCountByRegionsServiceInterface
{
    /**
     * @return array
     */
    public function getStatesStatistic() : array;
}