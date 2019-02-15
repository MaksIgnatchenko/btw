<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Rules;

use App\Modules\Orders\Models\Order;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class NotRatedOrderRule
 * @package App\Modules\Reviews\Rules
 */
class NotRatedOrderRule implements Rule
{

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        $order = Order::find($value);
        if (null === $order) {
            return false;
        }
        return !$order->rated;
    }

    /**
     * @return bool
     */
    public function message() : bool
    {
        return 'Order already rated';
    }
}
