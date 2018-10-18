<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchant\Rules;

use App\Modules\Users\Merchant\Adapters\ZipCodeValidationAdapter;
use App\Modules\Users\Merchant\Enums\CountryZipCodeRegExpEnum;
use Illuminate\Contracts\Validation\Rule;
use IsoCodes\ZipCode;

class CountryZipCodeRule implements Rule
{
    protected $country;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $country)
    {
        $this->country = $country;
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
        return ZipCodeValidationAdapter::validate($value, $this->country);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Zipcode/Postal code are not valid';
    }
}
