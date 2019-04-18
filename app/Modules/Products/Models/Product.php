<?php

namespace App\Modules\Products\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Products\Dto\CustomerSearchDto;
use App\Modules\Products\Enums\ProductFiltersEnum;
use App\Modules\Products\Enums\ProductOrdersEnum;
use App\Modules\Products\Filters\ProductFilter;
use App\Modules\Products\Helpers\AttributesHelper;
use App\Modules\Products\Repositories\ProductImageRepository;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Reviews\Models\ProductReview;
use App\Modules\Reviews\Traits\ComputedRatingTrait;
use App\Modules\Users\Merchant\Models\Store;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laratrust\Contracts\Ownable;

/**
 * Class Product
 * @package App\Modules\Products\Models
 */
class Product extends Model implements Ownable
{
    use ComputedRatingTrait;

    public const PRODUCTS_PAGE_LIMIT = 20;
    public const REVIEWS_PAGE_LIMIT = 3;
    public const DEFAULT_RADIUS = 100;

    public const PURCHASES_MULTIPLIER = 10;

    protected $productImageModel;

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
        'price',
        'delivery_price',
        'quantity',
        'store_id',
        'status',
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
        'price' => 'float',
        'delivery_price' => 'float',
        'quantity' => 'integer',
        'store_id' => 'integer',
        'attributes' => 'array',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'wishPivot',
        'is_in_wish_list',
        'recentlyViewedPivot',
    ];

    protected $appends = [
        'is_in_wish_list',
        'merchant_id',
        'rating',
        'review_count',
        'purchases_count',
    ];

    protected static function boot()
    {
        parent::boot();
        if (Auth::user() instanceof Customer) {
            static::addGlobalScope('status', function (Builder $builder) {
                $builder->where('status', '=', 'active');
            });
        }
    }

    /**
     * @param mixed $owner
     *
     * @return mixed
     */
    public function ownerKey($owner)
    {
        return $this->store->merchant_id;
    }

    public function __construct(array $attributes = [])
    {
        $this->productImageModel = app()[ProductImage::class];

        parent::__construct($attributes);
    }

    /**
     * @return bool
     */
    public function getIsInWishListAttribute(): bool
    {
        return (bool)$this->customersWishList()->where('customers.id', Auth::id())->count();
    }

    /**
     * @return mixed
     */
    public function getMerchantIdAttribute()
    {
        return $this->store->merchant->id;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customersWishList(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'wishlists');
    }

    /**
     * @param CustomerSearchDto $customerSearchDto
     *
     * @return Collection|null
     * @throws \App\Modules\Categories\Exceptions\NotFountCategory
     */
    public function customerSearch(CustomerSearchDto $customerSearchDto): ?Collection
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];

        /** @var Category $categoryModel */
        $categoryModel = app()[Category::class];

        /** @var array $categoryIds */
        $categoryIds = $customerSearchDto->getCategoryIds();

        $categories = [];

        if ($categoryIds) {
            foreach ($categoryIds as $id) {
                if (!$categoryModel::find($id)->is_final) {
                    $categories = array_merge($categories, $categoryModel
                        ->getFinalCategories($id)
                        ->pluck('id')->toArray());
                } else {
                    $categories[] = (int)$id;
                }
            }
        }

        return $productRepository->getProductsByConditions(
            $customerSearchDto->getOffset(),
            array_unique($categories),
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
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Merchant reviews
     *
     * @return HasMany
     */
    public function reviews() : HasMany
    {
        return $this->hasMany(ProductReview::class);
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
     * @throws \App\Exceptions\WrongFilterNameException
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
            case ProductOrdersEnum::RATING_HIGHEST:
                return $query->orderBy('rating', 'desc');
            case ProductOrdersEnum::RATING_LOWEST:
                return $query->orderBy('rating');
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

        return $productRepository->findOtherMerchantProducts($productId, $merchant->store->id, $offset);
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
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity;
        } else {
            $this->quantity = 0;
        }
    }

    /**
     * Attributes mutator.
     *
     * @param $value
     */
    public function setAttributesAttribute($value): void
    {
        $this->attributes['attributes'] = json_encode($value);
    }

    /**
     * Main image accessor.
     *
     * @param string $attribute
     *
     * @return string
     */
    public function getMainImageAttribute(string $attribute): string
    {
        return asset(Storage::url(config('wish.storage.products.main_images_path') . '/' . $attribute));
    }

    /**
     * Create product and store images.
     *
     * @param array $inputData
     * @param int   $storeId
     */
    public function createProduct(array $inputData, int $storeId): void
    {
        $this->loadMainImage($inputData, $storeId);
        $this->mergeAttributeArrays($inputData);

        $inputData['store_id'] = $storeId;

        $productRepository = app()[ProductRepository::class];
        $product = $productRepository->create($inputData);

        $this->loadAdditionalImages($inputData, $product);
    }

    /**
     * @param array $inputData
     */
    public function updateProduct(array $inputData)
    {
        $this->deleteOldImages($inputData);
        $this->loadMainImage($inputData);
        $this->loadAdditionalImages($inputData, $this);
        $this->mergeAttributeArrays($inputData);

        $productRepository = app()[ProductRepository::class];
        $productRepository->update($inputData, $this->id);
    }

    /**
     * Merge separated attribute array by types into one array
     *
     * @param array $inputData
     */
    protected function mergeAttributeArrays(array &$inputData)
    {
        $inputData['attributes'] = AttributesHelper::mergeAttributes($inputData['attributes'] ?? []);
    }

    /**
     * @param array    $inputData
     * @param int|null $storeId
     */
    protected function loadMainImage(array &$inputData, int $storeId = null)
    {
        if (!$storeId) {
            $storeId = $this->store_id;
        }

        if (isset($inputData['main_image'])) {
            $mainImageThumbnail = $this->productImageModel->createImageThumbnail($inputData['main_image']);

            $this->productImageModel->saveImageWithThumbnail(
                config('wish.storage.products.main_images_path'),
                config('wish.storage.products.main_images_thumb_path'),
                $inputData['main_image']->hashName(),
                $mainImageThumbnail,
                $storeId,
                $inputData['main_image']
            );

            $inputData['main_image'] = join('/', [$storeId, $inputData['main_image']->hashName()]);
        }
    }

    /**
     * @param array $inputData
     */
    protected function loadAdditionalImages(array $inputData, Product $product)
    {
        if (isset($inputData['product_gallery'])) {
            $this->productImageModel->saveGalleryImages($inputData['product_gallery'], $product->id, $product->store_id);
        }
    }

    /**
     * Remove old images from storage if new were uploaded
     *
     * @param array $inputData
     */
    protected function deleteOldImages(array $inputData)
    {
        $filesForDeleting = [];

        if (isset($inputData['main_image'])) {
            $filesForDeleting += [
                join('/', [config('wish.storage.products.main_images_path'), $this->main_image]),
                join('/', [config('wish.storage.products.main_images_thumb_path'), $this->main_image]),
            ];
        }

        if (isset($inputData['imgs_to_remove'])) {
            foreach (array_unique($inputData['imgs_to_remove']) as $imageUrl) {
                $filesForDeleting += [
                    join('/', [config('wish.storage.products.gallery_images_path'), $imageUrl]),
                    join('/', [config('wish.storage.products.gallery_images_thumb_path'), $imageUrl]),
                ];

                $imgName = pathinfo($imageUrl)['filename'];
                $productImageRepository = app(ProductImageRepository::class);

                $productImageRepository
                    ->findWhere([['image', 'like', "%$imgName%"]])
                    ->first()
                    ->delete();
            }
        }

        Storage::delete($filesForDeleting);
    }

    /**
     * @param int    $storeId
     * @param string $searchText
     *
     * @return mixed
     */
    public function search(int $storeId, string $searchText)
    {
        $productRepository = app()[ProductRepository::class];
        $productsPerPage = config('wish.store.pagination');

        return $productRepository->findStoreProductsBySearchTextWithPagination($storeId, $searchText, $productsPerPage);
    }

    /**
     * @param Builder $query
     * @param string $status
     * @return Builder
     */
    public function scopeOfStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param int $quantity
     */
    public function updatePurchaseCounter(int $quantity)
    {
        $this->attributes['purchases_count'] += $quantity;
        $this->save();
    }

    /**
     * @return int
     */
    public function getPurchasesCountAttribute() : int
    {
        $multipliedCount = $this->attributes['purchases_count'] * self::PURCHASES_MULTIPLIER; // Multiply count

        if (100 < $multipliedCount) {
            $multipliedCount = floor($multipliedCount / 100) * 100 + 100; // show only hundreds
        }
        return intval($multipliedCount);
    }
}

