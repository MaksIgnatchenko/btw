<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.12.2017
 */

namespace App\Modules\Users\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SetMerchantsCategoriesRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'categories'   => 'required|array:',
            'categories.*' => 'exists:categories,id',
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
