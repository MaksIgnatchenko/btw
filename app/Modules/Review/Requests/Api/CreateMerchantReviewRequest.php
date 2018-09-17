<?php

namespace App\Modules\Review\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateMerchantReviewRequest extends FormRequest
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
            'review'   => 'required|max:500',
            'rate'     => 'required|numeric|between:1,5',
            'order_id' => 'required|exists:orders,id',
        ];
    }
}
