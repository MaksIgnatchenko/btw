<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.11.2017
 */

namespace App\Modules\Categories\Enums;

class AttributeTypesEnum
{
    public const DIGITS = 'digits';
    public const TEXT = 'text';

    /**
     * @param string $value
     *
     * @return bool
     */
    public static function check(string $value): bool
    {
        if ($value === self::TEXT) {
            return true;
        }
        if ($value === self::DIGITS) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::DIGITS . ',' . self::TEXT;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::TEXT   => 'Text',
            self::DIGITS => 'Digits',
        ];
    }
}
