<?php

namespace App\Modules\Products\Repositories;

use App\Modules\Products\Dto\CoordinatesDto;
use App\Modules\Products\Models\Product;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
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
                }
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
                }
            ])->where('offer_end', '<', Carbon::now())
            ->orderBy('offer_end', 'desc')
            ->skip($offset)
            ->take(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    /**
     * @param int $offset
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
            ->limit(10)
            ->offset($offset);
        if (null !== $userIds) {
            $query->whereIn('user_id', $userIds);
        }

        return $query->get();
    }

    /**
     * @param int $offset
     * @param array|null $userIds
     *
     * @return Collection|null
     */
    public function getPopular(int $offset, $userIds = null): ?Collection
    {
        $query = Product::active()
            ->select(
                'id',
                'name',
                'regular_price',
                'offer_price',
                'main_image',
                'purchase_count',
                'parameters',
                'attributes',
                'offer_end',
                'return_details'
            )
            ->orderBy('purchase_count', 'desc')
            ->limit(10)
            ->offset($offset);

        if (null !== $userIds) {
            $query->whereIn('user_id', $userIds);
        }

        return $query->get();
    }


    /**
     * @param array $userIds
     * @param int $offset
     * @param array|null $categoryIds
     * @param string|null $keyword
     * @param string|null $barcode
     *
     * @return Collection
     */
    public function getProductsByConditions(
        array $userIds,
        int $offset,
        array $categoryIds = null,
        string $keyword = null,
        string $barcode = null
    ): Collection {
        $query = Product::active()
            ->whereIn('user_id', $userIds);

        if (!empty($categoryIds) && null !== $categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        }

        if (null !== $keyword) {
            $query->where('name', 'like', "%$keyword%");
        }

        if (null !== $barcode) {
            $query->where('barcode', "$barcode");
        }

        return $query->offset($offset)
            ->limit(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
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
            'user',
            'reviews' => function ($query) {
                return $query->take(Product::REVIEWS_PAGE_LIMIT)
                    ->select('review', 'product_id', 'customer_id')
                    ->where(['status' => ReviewStatusEnum::ACTIVE])
                    ->orderBy('created_at', 'DESC')
                    ->with([
                        'customer' => function ($query) {
                            return $query->select(['id', 'first_name', 'last_name']);
                        }
                    ]);
            },
            'category',
        ])->find($id);
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
     * @param int $userId
     * @param int $offset
     *
     * @return Collection
     */
    public function findOtherMerchantProducts(int $productId, int $userId, int $offset = 0): Collection
    {
        return Product::active()
            ->where('id', '!=', $productId)
            ->where('user_id', $userId)
            ->offset($offset)
            ->limit(Product::PRODUCTS_PAGE_LIMIT)
            ->get();
    }

    /**
     * @param int $productId
     */
    public function incrementCounter(int $productId, int $count): void
    {
        Product::whereId($productId)->increment('purchase_count', $count);
    }
}
