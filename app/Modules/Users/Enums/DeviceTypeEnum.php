<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.12.2017
 */

namespace App\Modules\Users\Enums;

class DeviceTypeEnum
{
    public const ANDROID = 'android';
    public const IOS = 'ios';

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::ANDROID . ',' . self::IOS;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::ANDROID => 'Android',
            self::IOS     => 'Ios',
        ];
    }

    /**
     * @param string $deviceType
     *
     * @return bool
     */
    public static function check(string $deviceType): bool
    {
        if (self::ANDROID === $deviceType) {
            return true;
        }
        if (self::IOS === $deviceType) {
            return true;
        }

        return false;
    }
}
