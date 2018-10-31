<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 31.10.2018
 */

namespace App\Modules\Users\Merchant\Helpers;

use App\Modules\Users\Merchant\Models\Merchant;

class MerchantHelper
{
    /**
     * @param Merchant $merchant
     * @return string
     */
    public static function getFullName(Merchant $merchant): string
    {
        return $merchant->first_name . ' ' . $merchant->last_name;
    }

    /**
     * @param Merchant $merchant
     * @return string
     */
    public static function getAvatarUrl(Merchant $merchant): string
    {
        //TODO create avatar logic
    }
}
