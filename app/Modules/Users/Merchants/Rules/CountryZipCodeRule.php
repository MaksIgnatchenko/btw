<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchants\Rules;

use App\Modules\Users\Merchants\Enums\CountryZipCodeRegExpEnum;
use Illuminate\Contracts\Validation\Rule;

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
        return preg_match(CountryZipCodeRegExpEnum::getZipCodeRegExpForCountry($this->country), $value) !== false;
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
