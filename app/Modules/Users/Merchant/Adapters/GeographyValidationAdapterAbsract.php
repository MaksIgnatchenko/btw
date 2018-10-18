<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Adapters;

use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;

abstract class GeographyValidationAdapterAbsract implements GeographyValidationAdapterInterface
{
    /**
     * @param $countryCode
     *
     * @return mixed
     */
    protected static function resolveCountry($countryCode)
    {
        $geographyService = app()[GeographyServiceInterface::class];

        return $geographyService->getCountryById($countryCode)->sortname;
    }
}