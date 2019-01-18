<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.01.2018
 */


namespace App\Modules\Orders\Requests\Web;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Rules\TrackingNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tracking_number' => [
                'required',
                'string',
                'max:255',
                new TrackingNumberRule(),
            ],
        ];
    }
}
