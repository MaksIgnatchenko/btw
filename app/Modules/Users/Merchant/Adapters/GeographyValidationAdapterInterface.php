<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Adapters;

interface GeographyValidationAdapterInterface
{
    public static function validate(string $value, int $country = null);
}