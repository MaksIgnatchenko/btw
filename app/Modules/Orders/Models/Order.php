<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.01.2018
 */

namespace App\Modules\Orders\Models;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Models\Transaction;
use App\Modules\Reviews\Models\ProductReview;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Customer\Models\CustomerDeliveryInformation;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Modules\Products\Helpers\ImagesPathHelper;

/**
 * @property int id
 * @property \stdClass product
 * @property int quantity
 */
class Order extends Model
{
    public const PAGE_LIMIT = 50;

    protected $fillable = [
        'customer_id',
        'merchant_id',
        'transaction_id',
        'product',
        'quantity',
        'status',
        'created_at',
        'updated_at',
        'tracking_number',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'merchant_id' => 'integer',
        'transaction_id' => 'string',

        'product' => 'object',
        'quantity' => 'integer',
        'status' => 'string',
        'is_dated' => 'bool',
    ];

    protected $appends = [
        'is_rated',
    ];

    protected $hidden = [
        'customer_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * @param int $merchantId
     *
     * @return Collection
     */
    public function getMerchantNotPaidOrders(int $merchantId): Collection
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);

        return $orderRepository->findMerchantNotPaidOrders($merchantId);
    }

    /**
     * @return bool
     */
    public function getIsRatedAttribute() : bool
    {
        return ProductReview::where('order_id', $this->id)->exists();
    }
    /**
     * @return float
     */
    public function getAmountAttribute(): float
    {
        $amount = $this->quantity * ($this->product->price + $this->product->delivery_price);

        return round($amount, 2);
    }

    /**
     * @param $product
     * @return \stdClass
     */
    public function getProductAttribute($product): \stdClass
    {
        $product = json_decode($product, false, 512, JSON_FORCE_OBJECT);
        $mutatedProduct = [];

        $mutatedProduct['id'] = $product->id;
        $mutatedProduct['name'] = $product->name;
        $mutatedProduct['price'] = $product->price;
        $mutatedProduct['delivery_price'] = $product->delivery_price;
        $mutatedProduct['store']['id'] = $product->store->id;
        $mutatedProduct['store']['name'] = $product->store->name;
        $mutatedProduct['store']['merchant_id'] = $product->store->merchant_id;
        $mutatedProduct['main_image'] = ImagesPathHelper::getProductImagePath($product->main_image);
        $mutatedProduct['main_image_thumb'] = ImagesPathHelper::getProductThumbPath($product->main_image);
        $mutatedProduct['description'] = $product->description;

        return (object)$mutatedProduct;
    }

    /**
     * @param int $merchantId
     * @param string $searchText
     * @return LengthAwarePaginator
     */
    public function search(int $merchantId, string $searchText): LengthAwarePaginator
    {
        $orderRepository = app()[OrderRepository::class];

        return $orderRepository->findMerchantOrdersBySearchTextWithPagination($merchantId, $searchText);
    }


    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeForCustomer($query)
    {
        return $query->with([
            'customer' => function ($query) {
                $query->select(['id', 'user_id', 'first_name', 'last_name'])->with([
                    'user' => function ($query) {
                        $query->select(['id', 'username', 'email']);
                    },
                    'deliveryAddress' => function ($query) {
                        $query->select(['customer_id', 'address', 'longitude', 'latitude']);
                    }
                ]);
            }
        ]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithoutQrCode($query)
    {
        return $query->select([
            'customer_id',
            'merchant_id',
            'product',
            'quantity',
            'status',
            'created_at',
            'delivery_option',
        ]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAmount($query)
    {
        return $query->select([
            'orders.*',
            DB::raw('TRUNCATE((product->\'$."price"\' + product->\'$."delivery_price"\') * quantity, 2) as amount'),
        ]);
    }


    /**
     * @param string|null $country
     * @return float
     */
    public function getTotalAmount(?string $country = null) : float
    {
        $query = DB::table($this->table)
            ->select(DB::raw('SUM(TRUNCATE((product->\'$."price"\' + product->\'$."delivery_price"\') * quantity, 2)) as amount'));
        if ($country) {
            $query->leftJoin('customer_delivery_information', 'orders.customer_id', '=', 'customer_delivery_information.customer_id')
                ->where('customer_delivery_information.country', $country);
        }
        return $query->get()[0]->amount ?? 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * @return bool
     */
    public function canBeShipped(): bool
    {
        return $this->status === OrderStatusEnum::IN_PROCESS;
    }

    /**
     * @return BelongsTo
     */
    public function customerDeliveryInformation() : BelongsTo
    {
        return $this->belongsTo(CustomerDeliveryInformation::class, 'customer_id', 'customer_id');
    }

    /**
     * @param $query
     * @param $country
     * @return mixed
     */
    public function scopeForCountry($query, $country)
    {
        return $query->whereHas('customerDeliveryInformation', function ($query) use ($country) {
            $query->where('country', $country);
        });
    }
}
