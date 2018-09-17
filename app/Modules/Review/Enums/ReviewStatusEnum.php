<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

namespace App\Modules\Reviews\Enums;

class ReviewStatusEnum
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
            self::NOT_ACTIVE => 'Not approved',
            self::ACTIVE     => 'Approved',
        ];
    }
}
