<?php
/**
 * Created by PhpStorm.
 * User: artempetrov
 * Date: 20.09.18
 * Time: 11:08
 */

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /** @var string*/
    protected $pattern = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?\d)(?=.*?[#?!@$%^&*-]).{6,}$/';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool)preg_match($this->pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your password must contain at least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.';
    }
}
