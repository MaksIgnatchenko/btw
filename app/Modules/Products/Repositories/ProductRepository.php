<?php

namespace App\Modules\Products\Repositories;

use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Common\BaseRepository;

class ProductRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Product::class;
    }

    /**
     * @param Product $product
     */
    public function save(Product $product)
    {
        $product->save();
    }

    /**
     * @param int $userId
     * @param int $offset
     *
     * @return Collection|null
     */
    public function getOutstandingOffers(int $userId, int $offset): Collection
    {
        return Product::active()
            ->where('user_id', $userId)
            ->with([
                'category' => function ($query) {
                    return $query->select('id', 'name');
                },
            ])
            ->orderBy('offer_end', 'desc')
            ->skip($offset)
            ->take(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    /**
     * @param int $userId
     * @param int $offset
     *
     * @return Collection
     */
    public function getExpiredOff(int $userId, int $offset): Collection
    {
        return Product::where('user_id', $userId)
            ->with([
                'category' => function ($query) {
                    return $query->select('id', 'name');
                },
            ])->where('offer_end', '<', Carbon::now())
            ->orderBy('offer_end', 'desc')
            ->skip($offset)
            ->take(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    /**
     * @param int   $offset
     *
     * @param array $userIds
     *
     * @return Collection|null
     */
    public function getPriceBreakers(int $offset, array $userIds = null): ?Collection
    {
        $sql = 'id, 
            name,
            regular_price, 
            offer_price,
            main_image,
            (products.regular_price / products.offer_price * 100 - 100) as price_break, 
            parameters,
            attributes, 
            offer_end, 
            return_details';

        $query = Product::active()
            ->select(DB::raw($sql))
            ->orderBy('price_break', 'desc')
            ->limit(Product::PRODUCTS_PAGE_LIMIT)
            ->offset($offset);

        return $query->get();
    }

    /**
     * @param int        $offset
     * @param array|null $userIds
     *
     * @return Collection|null
     */
    public function getPopular(int $offset, $userIds = null): ?Collection
    {
        $query = Product::orderBy('created_at', 'desc')
            ->limit(Product::PRODUCTS_PAGE_LIMIT)
            ->offset($offset);

        if (null !== $userIds) {
            $query->whereIn('user_id', $userIds);
        }

        return $query
            ->get()
            ->makeVisible('is_in_wish_list');
    }


    /**
     * @param int         $offset
     * @param array|null  $categoryIds
     * @param string|null $keyword
     * @param string|null $order
     * @param array|null  $filters
     *
     * @return Collection
     */
    public function getProductsByConditions(
        int $offset,
        array $categoryIds = null,
        string $keyword = null,
        string $order = null,
        array $filters = null
    ): Collection
    {
        $query = Product::query();

        if (!empty($categoryIds) && null !== $categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        }

        if (null !== $keyword) {
            $query->where('name', 'like', "%$keyword%");
        }

        if (null !== $order) {
            $query->order($order);
        }

        if (null !== $filters) {
            $query->filter($filters);
        }

        return $query->offset($offset)
            ->limit(Product::PRODUCTS_PAGE_LIMIT)
            ->get()
            ->makeVisible('is_in_wish_list');
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    public function getById(int $id): ?Product
    {
        return Product::with([
            'images',
            'category',
        ])
            ->find($id)
            ->makeVisible('is_in_wish_list');
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    public function findActiveById(int $id): ?Product
    {
        return Product::active()->with(['images'])->find($id);
    }

    /**
     * @param int $productId
     * @param int $storeId
     * @param int $offset
     *
     * @return Collection
     */
    public function findOtherMerchantProducts(int $productId, int $storeId, int $offset = 0): Collection
    {
        return Product::where('id', '!=', $productId)
            ->where('store_id', $storeId)
            ->offset($offset)
            ->limit(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    /**
     * @param int $productId
     * @param int $count
     */
    public function incrementCounter(int $productId, int $count): void
    {
        Product::whereId($productId)->increment('purchase_count', $count);
    }

    public function findStoreProductsBySearchTextWithPagination(int $storeId, string $searchText, int $perPage = 10)
    {
        return Product::where('products.name', 'LIKE', '%' . $searchText . '%')
            ->where('store_id', $storeId)
            ->paginate($perPage);
    }
}
