<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Enums;

class ReviewStatusEnum
{
    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';


    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        ];
    }

    /**
     * @return string
     */
    public static function toString(): string
    {
        return implode(',', array_keys(self::toArray()));
    }
}
