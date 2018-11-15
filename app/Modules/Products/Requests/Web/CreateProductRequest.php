<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 01.11.2018
 */

namespace App\Modules\Products\Requests\Web;

class CreateProductRequest extends UpdateProductRequestAbstract
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
        return parent::rules() + [
            'main_image' => 'required|mimes:' . config('wish.storage.products.image_mimes') . '|max:'
                . config('wish.storage.products.image_max_size'),
        ];
    }
}
