<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Adapters;

interface GeographyValidationAdapterInterface
{
    /**
     * @param string   $value
     * @param int|null $countryCode
     *
     * @return bool
     */
    public static function validate(string $value, int $countryCode): bool;
}