<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Adapters;

use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;

abstract class GeographyValidationAdapterAbsract implements GeographyValidationAdapterInterface
{
    protected static function resolveCountry($country)
    {
        $adaptee = app()[GeographyServiceInterface::class];

        return $adaptee->getCountryById($country)->sortname;
    }
}