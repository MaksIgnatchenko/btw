<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 27.11.2017
 */

namespace App\Modules\Categories\Enums;

class ParameterTypesEnum
{
    public const COUNT = 'quantity';
    public const OTHER_RESTRICTIONS = 'other_restrictions';
    public const BARCODE = 'barcode';
    public const VALID_DATE = 'valid_date';
    public const NOT_VALID_ON_HOLIDAYS = 'not_valid_on_holidays';

    /**
     * @param string $parameter
     *
     * @return bool
     */
    public static function check(string $parameter): bool
    {
        if (self::COUNT === $parameter) {
            return true;
        }
        if (self::OTHER_RESTRICTIONS === $parameter) {
            return true;
        }
        if (self::BARCODE === $parameter) {
            return true;
        }
        if (self::VALID_DATE === $parameter) {
            return true;
        }
        if (self::NOT_VALID_ON_HOLIDAYS === $parameter) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::COUNT
            . ','
            . self::OTHER_RESTRICTIONS
            . ','
            . self::BARCODE
            . ','
            . self::VALID_DATE
            . ','
            . self::NOT_VALID_ON_HOLIDAYS;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::COUNT      => 'Quantity',
            self::BARCODE    => 'Barcode',
            self::VALID_DATE => 'Valid date',

            self::OTHER_RESTRICTIONS => 'Other restrictions',
            self::NOT_VALID_ON_HOLIDAYS => 'Not valid on holidays',
        ];
    }
}
