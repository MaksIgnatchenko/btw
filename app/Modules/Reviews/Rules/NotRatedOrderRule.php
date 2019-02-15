<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Rules;

use App\Modules\Orders\Models\Order;
use Illuminate\Contracts\Validation\Rule;

class NotRatedOrderRule implements Rule
{
    public function passes($attribute, $value) : bool
    {
        return Order::where('id', $value)
            ->where('rated', false)
            ->exists();
    }

    public function message() : bool
    {
        return 'Order already rated';
    }
}
