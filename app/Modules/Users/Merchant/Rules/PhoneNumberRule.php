<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Rules;

use App\Modules\Users\Merchant\Adapters\PhoneNumberValidationAdapter;

class PhoneNumberRule extends RegistrationGeographyRuleAbstract
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
        return PhoneNumberValidationAdapter::validate($value, $this->country);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Phone number is not valid';
    }
}