<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.01.2018
 */

namespace App\Modules\Orders\Requests;

use App\Modules\Users\Enums\PaymentOptionsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOutcomeRequest extends FormRequest
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
            'payment_type' => ['required', Rule::in(PaymentOptionsEnum::getValues())],
            'amount'       => 'required|numeric',
            'fee'          => 'required|numeric|min:0|max:100',
            'net_amount'   => 'required|numeric',
            'payment_date' => 'required|date',
            'order_id'     => 'sometimes|array',
            'order_id.*'   => 'sometimes|exists:orders,id',
        ];
    }
}
