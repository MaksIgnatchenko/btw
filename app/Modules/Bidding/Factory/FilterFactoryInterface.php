<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */

namespace App\Modules\Bidding\Factories;

interface FilterFactoryInterface
{
    /**
     * @param string $filter
     *
     * @return FilterWishesInterface
     */
    public function get(string $filter): FilterWishesInterface;
}
