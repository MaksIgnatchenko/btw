<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */
namespace App\Modules\Reviews\Traits;

use App\Modules\Orders\Models\Order;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Customer\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait CommonReviewTrait
 * @package App\Modules\Reviews\Traits
 */
trait CommonReviewTrait
{
    /**
     * @return BelongsTo
     */
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->status === ReviewStatusEnum::ACTIVE;
    }

    /**
     * @param Builder $query
     * @param Order $order
     * @return Builder
     */
    public function scopeOfOrder(Builder $query, Order $order) : Builder
    {
        return $query->where('order_id', $order->id);
    }

    /**
     * @param Builder $query
     * @param Customer $customer
     * @return Builder
     */
    public function scopeOfCustomer(Builder $query, Customer $customer) : Builder
    {
        return $query->where('customer_id', $customer->id);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query) : Builder
    {
        return $query->where('status', ReviewStatusEnum::ACTIVE);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive(Builder $query) : Builder
    {
        return $query->where('status', ReviewStatusEnum::INACTIVE);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d M Y');
    }
}
