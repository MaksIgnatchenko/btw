<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 28.11.2018
 */

namespace App\Modules\Users\Customer\Helpers;

class SocialAuthHelper
{
    /**
     * @param array $userData
     * @return bool
     */
    public static function isAvatarExists(array $userData): bool
    {
        return array_key_exists('picture', $userData) && false === $userData['picture']['data']['is_silhouette'];
    }

    /**
     * @param string $extension
     * @return string
     */
    public static function createAvatarImageName(string $extension): string
    {
        return str_random(30) . '.' . $extension;
    }

    /**
     * @param array $userData
     * @return string
     */
    public static function getAvatarUrl(array $userData): string
    {
        return $userData['picture']['data']['url'];
    }
}
