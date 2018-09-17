<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

namespace App\Modules\Users\Enums;

class MerchantStatusEnum
{
    public const PENDING = 'pending';
    public const ACTIVE = 'active';
    public const NOT_ACTIVE = 'not-active';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::ACTIVE, self::NOT_ACTIVE, self::PENDING];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::ACTIVE . ',' . self::NOT_ACTIVE . ',' . self::PENDING;
    }
}
