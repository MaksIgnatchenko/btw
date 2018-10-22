<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 18.10.2018
 */

namespace App\Modules\Users\Merchant\Rules;

use Illuminate\Contracts\Validation\Rule;

abstract class RegistrationGeographyRuleAbstract implements Rule
{
    protected $country;

    /**
     * RegistrationGeographyRuleAbstract constructor.
     *
     * @param string|null $country
     */
    public function __construct(string $country = null)
    {
        $this->country = $country;
    }
}