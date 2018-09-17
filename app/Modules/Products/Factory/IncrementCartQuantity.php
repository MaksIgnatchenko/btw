<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Factory;

use App\Modules\Products\Models\Cart;

class IncrementCartQuantity extends AbstractChangeCartQuantity implements ChangeCartQuantityInterface
{
    /**
     * @param Cart $cart
     */
    public function make(Cart $cart)
    {
        $cart->quantity++;
        $this->saveCart($cart);
    }
}
