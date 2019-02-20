<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 19.02.2019
 */

namespace App\Modules\Products\Enums;


class ProductStatusEnum
{
    public const ACTIVE = 'active';
    public const ARCHIVED = 'archived';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::ACTIVE, self::ARCHIVED,];
    }

    public static function toArray() : array
    {
        return [
            self::ACTIVE => 'Active',
            self::ARCHIVED => 'Archived',
        ];
    }
}