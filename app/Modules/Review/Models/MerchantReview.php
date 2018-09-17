<?php

namespace App\Modules\Review\Models;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Review\Exceptions\WrongCustomerIdException;
use App\Modules\Review\Exceptions\WrongOrderStatusException;
use App\Modules\Review\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantReview extends Model
{
    public $fillable = [
        'review',
        'status',
        'rate',
        'customer_id',
        'merchant_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'review' => 'string',
        'status' => 'string',
        'rate'   => 'integer',

        'customer_id' => 'integer',
        'merchant_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'review' => 'required|max:1000',
        'status' => 'required|max:100',
        'rate'   => 'required|integer|between:1,5',
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
        /** @var MerchantReviewRepository $reviewRepository*/
        $reviewRepository = app(MerchantReviewRepository::class);

        $order = $orderRepository->find($orderId);

        if ($this->customer_id !== $order->customer_id) {
            throw new WrongCustomerIdException("Order with id {$orderId} doesn't belongs to customer with id {$this->customer_id}");
        }

        if (OrderStatusEnum::PICKED_UP !== $order->status) {
            throw new WrongOrderStatusException("Order with id {$orderId} must be picked up before you can left review");
        }

        $this->merchant_id = $order->merchant_id;
        $this->status = ReviewStatusEnum::NOT_ACTIVE;
        $reviewRepository->save($this);
    }

    /**
     * @return int
     */
    public function getPendingReviewCount(): int
    {
        /** @var MerchantReviewRepository $reviewRepository*/
        $reviewRepository = app(MerchantReviewRepository::class);

        return $reviewRepository->findWhere(['status' => ReviewStatusEnum::NOT_ACTIVE])->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
}
