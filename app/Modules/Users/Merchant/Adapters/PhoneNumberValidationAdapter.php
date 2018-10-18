<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Adapters;

use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use IsoCodes\PhoneNumber;

class PhoneNumberValidationAdapter extends GeographyValidationAdapterAbsract
{
    /**
     * @param string   $value
     * @param int|null $countryCode
     *
     * @return bool
     */
    public static function validate(string $value, int $countryCode = null): bool
    {
        if ($countryCode) {
            $country = self::resolveCountry($countryCode);
        }

        return PhoneNumber::validate($value, $country ?? null);
    }

}