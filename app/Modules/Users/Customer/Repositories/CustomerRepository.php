<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

namespace App\Modules\Users\Customer\Repositories;

use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\DTO\RecentlyViewedSearchDto;
use App\Modules\Users\Customer\DTO\WishListSearchDto;
use App\Modules\Users\Customer\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CustomerRepository
 * @package App\Modules\Users\Customer\Repositories
 */
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

    /**
     * @param Customer $customer
     * @param WishListSearchDto $wishListSearchDto
     * @return Collection
     */
    public function getWishList(Customer $customer, WishListSearchDto $wishListSearchDto): Collection
    {
        return $customer
            ->wishlist()
            ->where('name', 'like', "%{$wishListSearchDto->getKeyword()}%")
            ->offset($wishListSearchDto->getOffset())
            ->take(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    /**
     * @param Customer $customer
     * @param int $productId
     */
    public function addToWishList(Customer $customer, int $productId)
    {
        $customer->wishlist()->syncWithoutDetaching($productId);
    }

    /**
     * @param Customer $customer
     * @param int $productId
     */
    public function removeFromWishList(Customer $customer, int $productId)
    {
        $customer->wishlist()->detach($productId);
    }

    /**
     * @param Customer $customer
     * @param RecentlyViewedSearchDto $recentlyViewedSearchDto
     * @return Collection
     */
    public function getRecentlyViewed(Customer $customer, RecentlyViewedSearchDto $recentlyViewedSearchDto) : Collection
    {
        return $customer->recentlyViewed()
            ->where('recently_viewed_products.updated_at', '>=', Carbon::now()->subDay(30))
            ->where('name', 'like', "%{$recentlyViewedSearchDto->getKeyword()}%")
            ->skip($recentlyViewedSearchDto->getOffset())
            ->take(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }
}
