<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchant\Rules;

use App\Modules\Users\Merchant\Adapters\ZipCodeValidationAdapter;
use App\Modules\Users\Merchant\Enums\CountryZipCodeRegExpEnum;

class CountryZipCodeRule extends RegistrationGeographyRuleAbstract
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ZipCodeValidationAdapter::validate($value, $this->country);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Zipcode/Postal code is not valid';
    }
}
