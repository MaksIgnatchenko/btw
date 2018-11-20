<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */

namespace App\Modules\Orders\Factories;

interface FiltersFactoryInterface
{
    public static function get(string $filter): OrdersInterface;
}