<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Factory;

use App\Modules\Products\Models\Cart;
use App\Modules\Products\Repositories\CartRepository;

abstract class AbstractChangeCartQuantity
{
    /**
     * @param Cart $cart
     */
    public function saveCart(Cart $cart): void
    {
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        $cartRepository->save($cart);
    }
}
