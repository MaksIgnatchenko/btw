<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Repositories;

use App\Modules\Products\Enums\CartSourceEnum;
use App\Modules\Products\Models\Cart;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class CartRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Cart::class;
    }

    /**
     * @param Cart $cart
     */
    public function save(Cart $cart): void
    {
        $cart->save();
    }

    /**
     * @param int $productId
     * @param int $customerId
     *
     * @return Cart|null
     */
    public function findCartByConditions(int $productId, int $customerId): ?Cart
    {
        return Cart::where([
            'product_id'  => $productId,
            'customer_id' => $customerId
        ])->first();
    }

    /**
     * @param int $customerId
     *
     * @return Collection
     */
    public function findCartsWithProducts(int $customerId): Collection
    {
        return Cart::where(['customer_id' => $customerId])
            ->with('product')
            ->get();
    }

    /**
     * @param int $customerId
     *
     *
     * @return Collection
     */
    public function findWhereProductSource(int $customerId): Collection
    {
        return Cart::where([
            'customer_id' => $customerId,
            'source' => CartSourceEnum::PRODUCT,
        ])
            ->with('productRelation')
            ->get();
    }
}
