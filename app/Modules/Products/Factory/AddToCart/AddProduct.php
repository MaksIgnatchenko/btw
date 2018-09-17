<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.02.2018
 */

namespace App\Modules\Products\Factory\AddToCart;

use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Models\Cart;
use App\Modules\Products\Models\Product;

class AddProduct extends AbstractAddToCart implements AddToCartInterface
{
    /** @var Product $product */
    protected $product;
    /** @var int $customerId */
    protected $customerId;
    /** @var string $customerId */
    protected $deliveryOption;


    /**
     * AddProduct constructor.
     *
     * @param Product $product
     * @param int $customerId
     * @param string $deliveryOption
     */
    public function __construct(Product $product, int $customerId, string $deliveryOption)
    {
        parent::__construct();
        $this->product = $product;
        $this->customerId = $customerId;
        $this->deliveryOption = $deliveryOption;
    }

    public function execute(): void
    {
        $cart = app(Cart::class);
        $serializedProduct = $this->product->jsonSerialize();

        $cart->fill([
            'customer_id' => $this->customerId,
            'product_id'  => $this->product->id,
            'product'     => $serializedProduct,
            'quantity'    => Cart::PRODUCT_DEFAULT_QUANTITY,
            'source'      => CartSourceEnum::PRODUCT,

            'delivery_option' => $this->deliveryOption,
        ]);

        $this->cartRepository->save($cart);
    }
}
