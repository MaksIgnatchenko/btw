<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Factory;

use App\Modules\Products\Models\Cart;

interface ChangeCartQuantityInterface
{
    /**
     * @param Cart $cart
     */
    public function make(Cart $cart);
}
