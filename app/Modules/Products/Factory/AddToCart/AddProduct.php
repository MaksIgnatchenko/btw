<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.02.2018
 */

namespace App\Modules\Products\Factory\AddToCart;

use App\Modules\Products\Models\Cart;
use App\Modules\Products\Models\Product;

class AddProduct extends AbstractAddToCart implements AddToCartInterface
{
    /** @var Product $product */
    protected $product;
    /** @var int $customerId */
    protected $customerId;

    /**
     * AddProduct constructor.
     *
     * @param Product $product
     * @param int     $customerId
     */
    public function __construct(Product $product, int $customerId)
    {
        parent::__construct();
        $this->product = $product;
        $this->customerId = $customerId;
    }

    public function execute(): void
    {
        $cart = app(Cart::class);

        $cart->fill([
            'customer_id' => $this->customerId,
            'product_id'  => $this->product->id,
            'quantity'    => Cart::PRODUCT_DEFAULT_QUANTITY,
        ]);

        $this->cartRepository->save($cart);
    }
}
