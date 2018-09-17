<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.11.2017
 */


namespace App\Modules\Users\Enums;

class CustomerStatusEnum
{
    public const ACTIVE = 'active';
    public const NOT_ACTIVE = 'not-active';

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

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::NOT_ACTIVE => 'Not active',
            self::ACTIVE => 'Active',
        ];
    }
}
