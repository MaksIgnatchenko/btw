<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.12.2017
 */

namespace App\Modules\Products\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSearchRequest extends FormRequest
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
            'distance'  => 'required|integer|min:1|max:100',
            'longitude' => 'required|numeric',
            'latitude'  => 'required|numeric',
            'offset'    => 'sometimes|integer',
            'keyword'   => 'sometimes|string|max:50',
            'barcode'   => 'sometimes|string|max:20',

            'category_id' => 'sometimes|integer|exists:categories,id',
        ];
    }
}
