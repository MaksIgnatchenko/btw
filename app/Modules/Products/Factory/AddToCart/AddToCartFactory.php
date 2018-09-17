<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.02.2018
 */

namespace App\Modules\Products\Factory\AddToCart;

use App\Modules\Bidding\Repositories\BidRepository;
use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Exceptions\ProductAlreadyAddedException;
use App\Modules\Products\Exceptions\WrongSourceException;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Products\Repositories\ProductRepository;

class AddToCartFactory
{
    /** @var BidRepository $bidRepository */
    protected $bidRepository;
    /** @var ProductRepository $productRepository */
    protected $productRepository;

    public function __construct()
    {
        $this->bidRepository = app(BidRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * @param string $source
     * @param int $customerId
     * @param int $itemId
     *
     * @param string $deliveryOption
     *
     * @return AddToCartInterface
     * @throws ProductAlreadyAddedException
     * @throws WrongSourceException
     */
    public function get(string $source, int $customerId, int $itemId, string $deliveryOption): AddToCartInterface
    {
        switch ($source) {
            case CartSourceEnum::BID:
                $bid = $this->bidRepository->find($itemId);

                return new AddBid($bid, $customerId, $deliveryOption);

            case CartSourceEnum::PRODUCT:
                $product = $this->productRepository->find($itemId);

                return $this->getProductAdder($product, $customerId, $deliveryOption);

            default:
                throw new WrongSourceException("No such source: {$source}");
        }
    }

    /**
     * @param Product $product
     * @param int $customerId
     * @param string $deliveryOption
     *
     * @return AddToCartInterface
     * @throws ProductAlreadyAddedException
     */
    protected function getProductAdder(Product $product, int $customerId, string $deliveryOption): AddToCartInterface
    {
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        $cart = $cartRepository->findCartByConditions($product->id, $customerId);

        if (null !== $cart) {
            throw new ProductAlreadyAddedException('This product is already added to cart');
            // TODO delete if we decide not to use incrementing
//            return new IncrementCartQuantity($cart);
        }

        return new AddProduct($product, $customerId, $deliveryOption);
    }
}
