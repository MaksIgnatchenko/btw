<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.02.2018
 */

namespace App\Modules\Products\Factory\AddToCart;

use App\Modules\Bidding\Models\Bid;
use App\Modules\Bidding\Repositories\WishRepository;
use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Models\Cart;

class AddBid extends AbstractAddToCart implements AddToCartInterface
{
    /** @var Bid $bid */
    protected $bid;
    /** @var int $customerId */
    protected $customerId;
    /** @var string $deliveryOption */
    protected $deliveryOption;
    /** @var int $wishRepository */
    protected $wishRepository;

    /**
     * AddWish constructor.
     *
     * @param Bid $bid
     * @param int $customerId
     * @param string $deliveryOption
     */
    public function __construct(Bid $bid, int $customerId, string $deliveryOption)
    {
        parent::__construct();
        $this->bid = $bid;
        $this->customerId = $customerId;
        $this->deliveryOption = $deliveryOption;
        $this->wishRepository = app(WishRepository::class);
    }

    public function execute(): void
    {
        $cart = app(Cart::class);
        $wish = $this->bid->wish;
        $wish->is_added_to_cart = true;
        $product = $wish->product;
        // TODO bad to override price and tax in product
        $product->offer_price = $this->bid->price;
        $product->tax = $this->bid->tax;

        $cart->fill([
            'customer_id' => $this->customerId,
            'product_id'  => $product->id,
            'product'     => $product,
            'quantity'    => $wish->quantity,
            'source'      => CartSourceEnum::BID,

            'delivery_option' => $this->deliveryOption,
        ]);

        $this->cartRepository->save($cart);
        $this->wishRepository->save($wish);
    }
}
