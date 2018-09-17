<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Enums;

class UpdateCartActionEnum
{
    public const INCREMENT = 'increment';
    public const DECREMENT = 'decrement';

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::DECREMENT . ',' . self::INCREMENT;
    }
}
