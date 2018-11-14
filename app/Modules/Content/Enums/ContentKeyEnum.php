<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 7.11.2018
 */

namespace App\Modules\Content\Enums;

abstract class ContentKeyEnum
{
    public const TERMS_AND_CONDITIONS = 'terms_and_conditions';
    public const PRIVACY_POLICY = 'privacy_policy';
    public const ABOUT_US = 'about_us';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::TERMS_AND_CONDITIONS,
            self::PRIVACY_POLICY,
            self::ABOUT_US,
        ];
    }
}
