<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.01.2018
 */


namespace App\Modules\Orders\Requests;

use App\Modules\Orders\Enums\OrderStatusEnum;
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
            'status' => 'required|in:' . OrderStatusEnum::toString(),
        ];
    }
}
