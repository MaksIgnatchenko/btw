<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */


namespace App\Modules\Orders\Factories;

use App\Modules\Orders\Exceptions\WrongFilterException;
use App\Modules\Orders\Factories\FilterMerchantOrder\FilterMerchantOrderFactory;
use App\Modules\Orders\Factories\FilterOrder\FilterOrderFactory;
use App\Modules\Rbac\Enum\RolesEnum;

class FiltersFactory
{
    /**
     * @param string $roleName
     *
     * @return FiltersFactoryInterface
     * @throws WrongFilterException
     */
    public static function get(string $roleName): FiltersFactoryInterface
    {
        switch ($roleName) {
            case RolesEnum::CUSTOMER:
                return app(FilterOrderFactory::class);
            case RolesEnum::MERCHANT:
                return app(FilterMerchantOrderFactory::class);

            default:
                throw new WrongFilterException("No such role - {$roleName} for filters");
        }
    }
}
