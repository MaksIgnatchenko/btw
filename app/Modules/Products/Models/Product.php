<?php

namespace App\Modules\Products\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Products\Dto\CustomerSearchDto;
use App\Modules\Products\Enums\ProductFiltersEnum;
use App\Modules\Products\Enums\ProductOrdersEnum;
use App\Modules\Products\Exceptions\WrongStatusException;
use App\Modules\Products\Filters\ProductFilter;
use App\Modules\Products\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Product extends Model
{
    public const PRODUCTS_PAGE_LIMIT = 20;
    public const REVIEWS_PAGE_LIMIT = 3;
    public const DEFAULT_RADIUS = 100;

    /** @var array */
    public $fillable = [
        'category_id',
        'name',
        'attributes',
        'parameters',
        'description',
        'regular_price',
        'offer_price',
        'tax',
        'main_image',
        'store_delivery',
        'barcode',
        'offer_end',
        'user_id',
        'certificate',
        'return_details',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'regular_price' => 'float',
        'offer_price' => 'float',
        'tax' => 'float',
        'main_image' => 'string',
        'store_delivery' => 'boolean',
        'barcode' => 'string',
        'offer_end' => 'datetime',
        'user_id' => 'integer',
        'certificate' => 'boolean',
        'return_details' => 'string',
        'rating' => 'float',
    ];

    /**
     * @param CustomerSearchDto $customerSearchDto
     *
     * @return Collection|null
     */
    public function customerSearch(CustomerSearchDto $customerSearchDto): ?Collection
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];

        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app()[CategoryRepository::class];

        /** @var Category $categoryModel */
        $categoryModel = app()[Category::class];

        /** @var int $categoryId */
        $categoryId = $customerSearchDto->getCategoryId();

        $categoryIds = null;

        if ($categoryId) {
            $category = $categoryRepository->find($categoryId);
            $categories = new Collection([$category]);

            if (false === $category->is_final) {
                $categories = $categoryModel->getFinalCategories($categoryId);
            }

            $categoryIds = $categories->pluck('id')->toArray();
        }

        return $productRepository->getProductsByConditions(
            $customerSearchDto->getOffset(),
            $categoryIds,
            $customerSearchDto->getKeyword(),
            $customerSearchDto->getOrder(),
            $customerSearchDto->getFilters()
        );
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];

        return $productRepository->all()->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('offer_end', '>', Carbon::now());
    }

    /**
     * @param $query
     * @param $request
     *
     * @return mixed
     */
    public function scopeFilter($query, $data)
    {
        return (new ProductFilter($data, ProductFiltersEnum::toClassArray()))->filter($query);
    }

    /**
     * @param $query
     * @param $request
     *
     * @return mixed
     */
    public function scopeOrder($query, $order)
    {
        switch ($order) {
            case ProductOrdersEnum::PRICE_HIGHEST:
                return $query->orderBy('price', 'desc');
            case ProductOrdersEnum::PRICE_LOWEST:
                return $query->orderBy('price');
        }
    }

    /**
     * @param int $productId
     * @param int $merchantId
     * @param int $offset
     *
     * @return Collection
     */
    public function getOtherMerchantProducts(int $productId, int $merchantId, int $offset = 0): Collection
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);
        $merchant = $merchantRepository->find($merchantId);

        return $productRepository->findOtherMerchantProducts($productId, $merchant->user->id, $offset);
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        $parameters = $this->parameters;

        if (null === $parameters) {
            return null;
        }
        $parameters = \GuzzleHttp\json_decode($parameters);
        if (!isset($parameters->quantity)) {
            return null;
        }

        return $parameters->quantity;
    }

    /**
     * @param int $quantity
     */
    public function decreaseQuantity(int $quantity): void
    {
        $productQuantity = $this->getQuantity();
        if (null === $productQuantity) {
            return;
        }

        $parameters = \GuzzleHttp\json_decode($this->parameters);
        $parameters->quantity = (string)($parameters->quantity - $quantity);
        $this->parameters = \GuzzleHttp\json_encode($parameters);
    }
}
