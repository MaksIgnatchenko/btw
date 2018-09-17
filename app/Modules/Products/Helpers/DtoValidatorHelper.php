<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.12.2017
 */

namespace App\Modules\Products\Helpers;

class DtoValidatorHelper
{
    /**
     * @param $string
     *
     * @return bool
     */
    public static function checkBool($string): bool
    {
        $string = strtolower($string);

        return \in_array($string, ['true', 'false', '1', '0', 'yes', 'no'], true);
    }

    /**
     * @param string $day
     *
     * @return bool
     */
    public static function checkDay(string $day): bool
    {
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        return \in_array($day, $days, true);
    }

    /**
     * @param string $day
     *
     * @return bool
     */
    public static function checkTime(string $day): bool
    {
        $regExp = '/^\b((1[0-2]|0?[\d]).([0-5][\d]) ([AP][M]))$/';

        return preg_match($regExp, $day);
    }
}