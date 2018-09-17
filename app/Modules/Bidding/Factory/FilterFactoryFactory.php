<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 30.01.2018
 */

namespace App\Modules\Bidding\Factories;

use App\Modules\Bidding\Exceptions\WrongFilterException;
use App\Modules\Bidding\Factories\FilterCustomer\FilterCustomerFactory;
use App\Modules\Bidding\Factories\FilterMerchant\FilterMerchantFactory;
use App\Modules\Rbac\Enum\RolesEnum;

class FilterFactoryFactory
{
    /**
     * @param string $role
     *
     * @return FilterFactoryInterface
     * @throws WrongFilterException
     */
    public static function get(string $role): FilterFactoryInterface
    {
        switch ($role) {
            case RolesEnum::CUSTOMER:
                return new FilterCustomerFactory();
            case RolesEnum::MERCHANT:
                return new FilterMerchantFactory();
            default:
                throw new WrongFilterException("No such role {$role}");
        }
    }
}
