<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 01.11.2018
 */

namespace App\Modules\Products\Requests\Web;

use App\Modules\Products\Enums\AttributeTypesEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'main_image' => 'required|mimes:' . config('wish.storage.products.image_mimes') . '|max:' . config('wish.storage.products.image_max_size'),
            'product_gallery.*' => 'mimes:' . config('wish.storage.products.image_mimes') . '|max:' . config('wish.storage.products.image_max_size'),
            'price' => 'required|numeric|between:0.01,9999999',
            'attributes.text.*' => 'required|string|max:100',
            'attributes.digits.*' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'attributes.text.*.required' => 'The attribute field is required.',
            'attributes.text.*.string' => 'The attribute field must be a string',
            'attributes.text.*.max' => 'The attribute field may not be greater than 5 characters.',
            'attributes.digits.*.required' => 'The attribute field is required',
            'attributes.digits.*.integer' => 'The attribute field must be an integer.',
            'product_gallery.*.mimes' => 'Product gallery images must be files of types' . config('wish.storage.products.image_mimes') . '.',
            'product_gallery.*.max' => 'Product gallery images may not be greater than' . config('wish.storage.products.image_max_size') . 'kilobytes.',
        ];
    }
}
