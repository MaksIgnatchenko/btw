<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Factory;

use App\Modules\Products\Exceptions\WrongProductCartQuantityException;
use App\Modules\Products\Models\Cart;

class DecrementCartQuantity extends AbstractChangeCartQuantity implements ChangeCartQuantityInterface
{
    /**
     * @param Cart $cart
     *
     * @throws \App\Modules\Products\Exceptions\WrongProductCartQuantityException
     */
    public function make(Cart $cart)
    {
        if ($cart->quantity <= Cart::PRODUCT_MIN_QUANTITY) {
            throw new WrongProductCartQuantityException("Too low quantity for cart with id {$cart->id}");
        }

        $cart->quantity--;
        $this->saveCart($cart);
    }
}
