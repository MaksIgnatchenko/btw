<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Adapters;

use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use IsoCodes\ZipCode;

class ZipCodeValidationAdapter extends GeographyValidationAdapterAbsract
{
    public static function validate(string $value, int $country = null)
    {
        if ($country) {
            $country = self::resolveCountry($country);
        }

        return ZipCode::valid($value, $country);
    }
}