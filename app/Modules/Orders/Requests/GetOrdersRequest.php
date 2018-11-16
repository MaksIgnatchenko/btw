<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Requests;

use App\Modules\Order\Enums\OrderMerchantFilterEnum;
use App\Modules\Orders\Enums\OrderFilterEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetOrdersRequest extends FormRequest
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
            'filter' => [
                'required',
                Rule::in(OrderFilterEnum::toArray())
            ],
            'offset' => 'numeric',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'filter.in' => 'Wrong value. Available values - '
                . OrderFilterEnum::toString()
        ];
    }
}
