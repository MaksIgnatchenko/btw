<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 22.11.2018
 */

namespace App\Helpers;

use App\Enums\FileSizeMeasurementEnum;

abstract class FileSizeConverter
{
    protected const BASE = 1024;

    /**
     * @param int $value
     * @param     $from
     * @param     $to
     *
     * @return float|int
     */
    public static function convert(int $value, $from, $to): int
    {
        return $value * self::calculateKoef($from, $to);
    }

    /**
     * @param $from
     * @param $to
     *
     * @return int
     */
    protected static function calculateKoef($from, $to)
    {
        $diff = FileSizeMeasurementEnum::toArrayKoefs()[$from] - FileSizeMeasurementEnum::toArrayKoefs()[$to];
        return self::BASE ** $diff;
    }
}
