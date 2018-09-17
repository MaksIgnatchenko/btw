<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Products\Enums\TransactionStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'transaction_id' => 'exists:transactions:id',
            'status'         => [
                'required',
                Rule::in([
                    TransactionStatusEnum::SUCCESS,
                    TransactionStatusEnum::FAIL
                ])
            ],
            'message'        => 'sometimes|string|max:10000'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'status.in' => 'Wrong status. Available values: ' . TransactionStatusEnum::SUCCESS . ',' . TransactionStatusEnum::FAIL,
        ];
    }
}
