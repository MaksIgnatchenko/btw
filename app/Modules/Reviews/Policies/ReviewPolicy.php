<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Policies;

use App\Modules\Orders\Models\Order;
use App\Modules\Users\Customer\Models\Customer;

class ReviewPolicy
{
    public function create(Customer $customer) : bool
    {
        $order = Order::find(request('order_id'), ['customer_id']);
        if (null === $order) {
            return false;
        }
        return $customer->id === $order->customer_id;
    }
}
