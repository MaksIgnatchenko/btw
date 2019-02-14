<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */
namespace App\Modules\Reviews\Traits;

use App\Modules\Orders\Models\Order;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Builder;

trait CommonReviewsScopesTrait
{
    public function scopeOfOrder(Builder $query, Order $order) : Builder
    {
        return $query->where('order_id', $order->id);
    }


    public function scopeOfCustomer(Builder $query, Customer $customer) : Builder
    {
        return $query->where('customer_id', $customer->id);
    }

    public function scopeActive(Builder $query) : Builder
    {
        return $query->where('status', ReviewStatusEnum::ACTIVE);
    }

    public function scopeInactive(Builder $query) : Builder
    {
        return $query->where('status', ReviewStatusEnum::INACTIVE);
    }
}