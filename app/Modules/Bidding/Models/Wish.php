<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Bidding\Models;

use App\Modules\Bidding\Repositories\WishRepository;
use App\Modules\Categories\Models\Category;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Users\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Wish extends Model
{
    public const PAGE_LIMIT = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product',
        'category_id',
        'name',
        'longitude',
        'latitude',
        'quantity',
        'desired_price',
        'max_price',
        'end_date',
    ];

    protected $casts = [
        'product'       => 'object',
        'category_id'   => 'integer',
        'name'          => 'string',
        'longitude'     => 'float',
        'latitude'      => 'float',
        'quantity'      => 'integer',
        'desired_price' => 'float',
        'max_price'     => 'float',
        'end_date'      => 'datetime',
        'bids_count'    => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * @return HasMany
     */
    public function declinedWishes(): HasMany
    {
        return $this->hasMany(DeclinedWish::class);
    }

    /**
     * @return HasMany
     */
    public function lowestBid(): HasMany
    {
        return $this->hasMany(Bid::class)
            ->select('wish_id', DB::raw('MIN(bids.price) as total_price'))
            ->groupBy('wish_id');
    }

    /**
     * @return HasOne
     */
    public function myBid()
    {
        return $this->hasOne(Bid::class);
    }

    /**
     * @param $query
     */
    public function scopeActive($query)
    {
        $query->where('end_date', '>', Carbon::now());
    }

    /**
     * @param $query
     */
    public function scopeWithoutDeclined($query)
    {
        $query->hasNot('declinedWishes');
    }

    /**
     * @param $query
     */
    public function scopeWithoutUnused($query)
    {
        $query->select(['id', 'product', 'quantity', 'desired_price', 'max_price', 'end_date']);
    }

    /**
     * @param $query
     */
    public function scopeBidCount($query)
    {
        $query->withCount('bids');
    }

    /**
     * @param $query
     * @param $merchantId
     */
    public function scopeIsBidByMe($query, $merchantId)
    {
        $query->with([
            'myBid' => function ($query) use ($merchantId) {
                return $query->where(['merchant_id' => $merchantId]);
            }
        ]);
    }

    /**
     * @param Customer $customer
     * @param int $productId
     * @param $bidEnd
     */
    public function create(Customer $customer, int $productId, $bidEnd): void
    {
        $wish = $this;

        /** @var WishRepository $wishRepository */
        $wishRepository = app(WishRepository::class);
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);
        $product = $productRepository->findActiveById($productId);

        $wish->product = $product;
        $wish->end_date = (new Carbon())->addDays($bidEnd);
        $wish->category_id = $product->category_id;
        $wish->name = $product->name;
        $wish->barcode = $product->barcode;
        $wish->customer_id = $customer->id;

        $customerAddress = $customer->address;
        if (null !== $customerAddress) {
            $wish->longitude = $customerAddress->longitude;
            $wish->latitude = $customerAddress->latitude;
        }

        $wishRepository->save($wish);
    }
}
