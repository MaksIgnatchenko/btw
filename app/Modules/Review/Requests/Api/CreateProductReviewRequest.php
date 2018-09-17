<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 25.01.2018
 */

namespace App\Modules\Review\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductReviewRequest extends FormRequest
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
            'review'   => 'required|string|max:500',
            'order_id' => 'required|exists:orders,id',
        ];
    }
}
