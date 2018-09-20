<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.11.2017
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ConvertStringBooleans extends TransformsRequest
{
    /**
     * @param string $key
     * @param mixed $value
     *
     * @return bool|mixed
     */
    protected function transform($key, $value)
    {
        if ($value === 'true' || $value === 'TRUE') {
            return true;
        }

        if ($value === 'false' || $value === 'FALSE') {
            return false;
        }

        return $value;
    }
}
