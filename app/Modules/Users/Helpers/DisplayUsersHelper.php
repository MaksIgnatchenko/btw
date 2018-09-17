<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Helpers;

use App\Modules\Users\Models\AbstractCustomerAddress;

class DisplayUsersHelper
{
    /**
     * @param AbstractCustomerAddress|null $customerAddress
     *
     * @return string
     */
    public static function displayAddress(AbstractCustomerAddress $customerAddress = null): string
    {
        return null !== $customerAddress ? $customerAddress->address : '<span class="text-red">Empty<span>';
    }
}
