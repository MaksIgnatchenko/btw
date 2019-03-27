<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /** @var string */
    protected $pattern = '/^(?=.*[0-9])(?=.*[a-zA-Z])(.+)$/';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        dd((bool)preg_match($this->pattern, $value));
        return (bool)preg_match($this->pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your password must contain at least 1 Uppercase, 1 Lowercase and 1 Numeric character.';
    }
}