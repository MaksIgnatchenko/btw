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
    /**
     * @param string   $value
     * @param int|null $countryCode
     *
     * @return mixed
     */
    public static function validate(string $value, int $countryCode = null): bool
    {
        if ($countryCode) {
            $country = self::resolveCountry($countryCode);
        }

        try {
            return ZipCode::validate($value, $country ?? null);
        } catch (\InvalidArgumentException $e) {
            return true;
        }

    }
}