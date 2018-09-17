<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Factories\FilterCustomer;

use App\Modules\Bidding\Enums\CustomerFilterEnum;
use App\Modules\Bidding\Exceptions\WrongFilterException;
use App\Modules\Bidding\Factories\FilterFactoryInterface;
use App\Modules\Bidding\Factories\FilterWishesInterface;

class FilterCustomerFactory implements FilterFactoryInterface
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
            case CustomerFilterEnum::ALL:
                return new All();
            case  CustomerFilterEnum::MY:
                return new My();
            case CustomerFilterEnum::BID_RESULT:
                return new BidResult();
            default:
                throw new WrongFilterException("No such filter {$filter}");
        }
    }
}
