<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Rules;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class PickedUpOrderRule
 * @package App\Modules\Reviews\Rules
 */
class PickedUpOrderRule implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        return Order::where('id', $value)
            ->where('status', OrderStatusEnum::PICKED_UP)
            ->exists();
    }

    /**
     * @return bool
     */
    public function message() : bool
    {
        return 'Order must be picked up';
    }
}
