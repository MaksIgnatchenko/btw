<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

namespace App\Modules\Users\Customer\Repositories;

use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\DTO\WishListSearchDto;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use InfyOm\Generator\Common\BaseRepository;

class CustomerRepository extends BaseRepository
{
    /**
     * Configure the Model.
     *
     * @return string
     */
    public function model(): string
    {
        return Customer::class;
    }

    public function getWishList(Customer $customer, WishListSearchDto $wishListSearchDto): Collection
    {
        return $customer
            ->wishlist()
            ->where('name', 'like', "%{$wishListSearchDto->getKeyword()}%")
            ->offset($wishListSearchDto->getOffset())
            ->take(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    public function addToWishList(Customer $customer, int $productId)
    {
        $customer->wishlist()->syncWithoutDetaching($productId);
    }

    public function removeFromWishList(Customer $customer, int $productId)
    {
        $customer->wishlist()->detach($productId);
    }
}