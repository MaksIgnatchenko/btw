<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

namespace App\Modules\Advert\Enums;

class AdvertStatusEnum
{
    public const ACTIVE = 'active';
    public const NOT_ACTIVE = 'not-active';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::ACTIVE     => 'Active',
            self::NOT_ACTIVE => 'Not active',
        ];
    }

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::ACTIVE, self::NOT_ACTIVE];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::ACTIVE . ',' . self::NOT_ACTIVE;
    }
}
