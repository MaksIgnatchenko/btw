<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Factories\FilterMerchant;

use App\Modules\Bidding\Enums\MerchantFilterEnum;
use App\Modules\Bidding\Exceptions\WrongFilterException;
use App\Modules\Bidding\Factories\FilterFactoryInterface;
use App\Modules\Bidding\Factories\FilterWishesInterface;

class FilterMerchantFactory implements FilterFactoryInterface
{
    /**
     * @param string $filter
     *
     * @return FilterWishesInterface
     * @throws \App\Modules\Bidding\Exceptions\WrongFilterException
     */
    public function get(string $filter): FilterWishesInterface
    {
        switch ($filter) {
            case MerchantFilterEnum::ALL:
                return new All();
            default:
                throw new WrongFilterException("No such filter: {$filter}");
        }
    }
}
