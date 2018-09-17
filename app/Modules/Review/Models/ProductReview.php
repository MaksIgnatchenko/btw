<?php

namespace App\Modules\Review\Models;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Models\Product;
use App\Modules\Review\Exceptions\WrongCustomerIdException;
use App\Modules\Review\Exceptions\WrongOrderStatusException;
use App\Modules\Review\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    public $fillable = [
        'review',
        'status',
        'product_id',
        'customer_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'review' => 'string',
        'status' => 'string',

        'product_id'  => 'integer',
        'merchant_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'review' => 'required|max:500',
        'status' => 'required|max:100'
    ];

    /**
     * @param int $orderId
     *
     * @throws WrongCustomerIdException
     * @throws WrongOrderStatusException
     */
    public function create(int $orderId): void
    {
        // TODO копипаста
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        /** @var ProductReviewRepository $reviewRepository*/
        $reviewRepository = app(ProductReviewRepository::class);

        $order = $orderRepository->find($orderId);

        if ($this->customer_id !== $order->customer_id) {
            throw new WrongCustomerIdException("Order with id {$orderId} doesn't belongs to customer with id {$this->customer_id}");
        }

        if (OrderStatusEnum::PICKED_UP !== $order->status) {
            throw new WrongOrderStatusException("Order with id {$orderId} must be picked up before you can left review");
        }

        $this->product_id = $order->product->id;
        $this->status = ReviewStatusEnum::NOT_ACTIVE;
        $reviewRepository->save($this);
    }

    /**
     * @return int
     */
    public function getPendingReviewCount(): int
    {
        /** @var ProductReviewRepository $reviewRepository*/
        $reviewRepository = app(ProductReviewRepository::class);

        return $reviewRepository->findWhere(['status' => ReviewStatusEnum::NOT_ACTIVE])->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
