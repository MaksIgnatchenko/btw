<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 15.11.2018
 */

namespace App\Modules\Products\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

abstract class ProductRequestAbstract extends FormRequest
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
     * Request validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'attributes' => 'sometimes|array',
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'quantity' => 'required|numeric|between:0,9999',
            'product_gallery.*' => 'mimes:' . config('wish.storage.products.image_mimes') . '|max:' . config('wish.storage.products.image_max_size'),
            'price' => 'required|numeric|between:0.01,9999999',
            'delivery_price' => 'required|numeric|between:0,9999999',
            'attributes.text.*' => 'required|string|max:100',
            'attributes.digits.*' => 'required|integer',
        ];
    }
}
