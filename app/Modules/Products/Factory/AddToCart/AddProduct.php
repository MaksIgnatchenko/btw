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
    /** @var int $customerId */
    protected $qauntity;

    /**
     * AddProduct constructor.
     *
     * @param Product $product
     * @param int     $customerId
     * @param int     $quantity
     */
    public function __construct(Product $product, int $customerId, int $quantity = Cart::PRODUCT_DEFAULT_QUANTITY)
    {
        parent::__construct();
        $this->product = $product;
        $this->customerId = $customerId;
        $this->qauntity = $quantity;
    }

    public function execute(): void
    {
        $cart = app(Cart::class);

        $cart->fill([
            'customer_id' => $this->customerId,
            'product_id'  => $this->product->id,
            'quantity'    => $this->qauntity,
        ]);

        $this->cartRepository->save($cart);
    }
}
