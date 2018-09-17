<?php

namespace App\Modules\Products\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Products\Dto\CustomerSearchDto;
use App\Modules\Products\Enums\ProductFiltersEnum;
use App\Modules\Products\Exceptions\WrongStatusException;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Scopes\ProductLocalDeliveryScope;
use App\Modules\Review\Models\ProductReview;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\MerchantRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Product extends Model
{
    public const PRODUCTS_PAGE_LIMIT = 50;
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
        'category_id'    => 'integer',
        'name'           => 'string',
        'description'    => 'string',
        'regular_price'  => 'float',
        'offer_price'    => 'float',
        'tax'            => 'float',
        'main_image'     => 'string',
        'store_delivery' => 'boolean',
        'barcode'        => 'string',
        'offer_end'      => 'datetime',
        'user_id'        => 'integer',
        'certificate'    => 'boolean',
        'return_details' => 'string',
        'rating'         => 'float',
    ];

    /**
     * The "booting" method of the model.
     *
     * @throws \InvalidArgumentException
     */
    protected static function boot(): void
    {
        parent::boot();
        // TODO it have to be moved from scope!
        static::addGlobalScope(new ProductLocalDeliveryScope);
    }

    /**
     * @param string $filter
     * @param int $userId
     *
     * @param int $offset
     *
     * @return Collection
     * @throws WrongStatusException
     */
    public function getProductsByFilter(string $filter, int $userId, int $offset): Collection
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];

        switch ($filter) {
            case ProductFiltersEnum::OUTSTANDING_OFFERS:
                return $productRepository->getOutstandingOffers($userId, $offset);
            case ProductFiltersEnum::EXPIRED_OFF:
                return $productRepository->getExpiredOff($userId, $offset);

            default:
                throw new WrongStatusException("No such filter: $filter");
        }
    }

    /**
     * @param CustomerSearchDto $customerSearchDto
     *
     * @return Collection|null
     */
    public function customerSearch(CustomerSearchDto $customerSearchDto): ?Collection
    {
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app()[MerchantRepository::class];
        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app()[Category::class];
        /** @var Category $categoryModel */
        $categoryModel = app()[Category::class];
        /** @var int $categoryId */
        $categoryId = $customerSearchDto->getCategoryId();

        $merchantsInRadius = $merchantRepository->getInRadius(
            $customerSearchDto->getLongitude(),
            $customerSearchDto->getLatitude(),
            $customerSearchDto->getDistance()
        );
        // if there is no merchants near
        if ($merchantsInRadius->isEmpty()) {
            return null;
        }

        $userIdsInRadius = $merchantsInRadius->pluck('user_id')->toArray();

        if (null === $categoryId) {
            return $productRepository->getProductsByConditions(
                $userIdsInRadius,
                $customerSearchDto->getOffset(),
                null,
                $customerSearchDto->getKeyword(),
                $customerSearchDto->getBarcode()
            );
        }

        $category = $categoryRepository->find($categoryId);

        $finalCategories = new Collection([$category]);
        if (false === $category->is_final) {
            $finalCategories = $categoryModel->getFinalCategories($categoryId);
        }

        return $productRepository->getProductsByConditions(
            $userIdsInRadius,
            $customerSearchDto->getOffset(),
            $finalCategories->pluck('id')->toArray(),
            $customerSearchDto->getKeyword(),
            $customerSearchDto->getBarcode()
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')
            ->limit(self::REVIEWS_PAGE_LIMIT)
            ->where(['status' => ReviewStatusEnum::ACTIVE]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localDelivery(): HasOne
    {
        return $this->hasOne(ProductLocalDelivery::class, 'product_id', 'id');
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
