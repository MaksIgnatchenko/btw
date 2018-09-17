<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Enums;

class UserSettingsEnum
{
    public const TOUCH_ID = 'touchId';
    public const SEND_PUSH = 'sendPush';
    public const CATEGORIES = 'sendPush';

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::TOUCH_ID . ',' . self::SEND_PUSH;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::TOUCH_ID  => 'Touch Id',
            self::SEND_PUSH => 'Sending push',
        ];
    }

    /**
     * @param string $setting
     *
     * @return bool
     */
    // TODO изменить
    public static function checkCustomer(string $setting): bool
    {
        if (self::TOUCH_ID === $setting) {
            return true;
        }
        if (self::SEND_PUSH === $setting) {
            return true;
        }
        if (self::CATEGORIES === $setting) {
            return true;
        }

        return false;
    }

    /**
     * @param string $setting
     *
     * @return bool
     */
    // TODO изменить
    public static function checkMerchant(string $setting): bool
    {
        if (self::TOUCH_ID === $setting) {
            return true;
        }
        if (self::SEND_PUSH === $setting) {
            return true;
        }
        if (self::CATEGORIES === $setting) {
            return true;
        }

        return false;
    }
}
