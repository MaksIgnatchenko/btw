<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.02.2018
 */

namespace App\Modules\Products\Factory\AddToCart;

use App\Modules\Products\Models\Cart;
use App\Modules\Products\Repositories\CartRepository;

class IncrementCartQuantity implements AddToCartInterface
{
    /** @var Cart $cart */
    protected $cart;
    /** @var CartRepository $cartRepository */
    protected $cartRepository;

    /**
     * IncrementCartQuantity constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->cartRepository = app(CartRepository::class);
    }

    public function execute(): void
    {
        $this->cart->quantity++;
        $this->cartRepository->save($this->cart);
    }
}
