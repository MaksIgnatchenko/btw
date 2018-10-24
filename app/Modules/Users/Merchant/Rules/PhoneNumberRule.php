<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Rules;

use App\Modules\Users\Merchant\Adapters\PhoneNumberValidationAdapter;

class PhoneNumberRule extends RegistrationGeographyRuleAbstract
{
    protected $phone_code;

    /**
     * PhoneNumberRule constructor.
     *
     * @param string $country
     * @param string $phoneCode
     */
    public function __construct(string $country = null, string $phoneCode = null)
    {
        parent::__construct($country);

        $this->phone_code = $phoneCode;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!$this->country || !$this->phone_code) {
            return false;
        }

        return PhoneNumberValidationAdapter::validate($this->phone_code . $value, $this->country);
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