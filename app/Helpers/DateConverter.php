<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.11.2017
 */

namespace App\Helpers;

use Carbon\Carbon;

class DateConverter
{
    protected const DATE_FORMAT = 'm/d/y';

    /**
     * @param string $date
     *
     * @return string
     */
    public static function date(string $date = null): ?string
    {
        if (null === $date) {
            return null;
        }

        return Carbon::parse($date)->format(self::DATE_FORMAT);
    }
}
