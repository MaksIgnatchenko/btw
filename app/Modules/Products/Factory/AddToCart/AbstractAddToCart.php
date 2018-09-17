<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.02.2018
 */

namespace App\Modules\Products\Factory\AddToCart;

use App\Modules\Products\Repositories\CartRepository;

abstract class AbstractAddToCart
{
    protected $cartRepository;

    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
    }
}
