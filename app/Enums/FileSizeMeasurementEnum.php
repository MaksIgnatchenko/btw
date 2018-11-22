<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 22.11.2018
 */

namespace App\Enums;

abstract class FileSizeMeasurementEnum
{
    public const MB = 'mb';
    public const KB = 'kb';
    public const BYTE = 'b';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::BYTE => 'byte',
            self::KB => 'kilobyte',
            self::MB => 'megabyte',
        ];
    }

    /**
     * @return array
     */
    public static function toArrayKoefs(): array
    {
        return [
            self::BYTE => 0,
            self::KB => 1,
            self::MB => 2,
        ];
    }
}
