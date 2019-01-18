<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-18
 * Time: 16:35
 */

namespace App\Modules\Orders\Rules;

use Illuminate\Contracts\Validation\Rule;

class TrackingNumberRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // ePacket tracking number is a 13-digit tracking code starting with letter "LQ/LK/LM/LN/LX/LS/AG" and ending with "CN". eg. LS123456789CN.
        return preg_match('/^(?:(LQ|LK|LM|LN|LX|LS|AG)+[0-9]{9}+CN)$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong tracking number. ePacket tracking number is a 13-digit tracking code starting with letter "LQ/LK/LM/LN/LX/LS/AG" and ending with "CN".';
    }
}