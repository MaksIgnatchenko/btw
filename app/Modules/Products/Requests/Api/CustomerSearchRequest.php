<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.12.2017
 */

namespace App\Modules\Products\Requests\Api;

use App\Modules\Products\Enums\ProductFiltersEnum;
use App\Modules\Products\Enums\ProductOrdersEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'offset' => 'sometimes|integer',
            'keyword' => 'sometimes|string|max:50',
            'category' => 'sometimes|integer|exists:categories,id',
            'order' => ['sometimes', Rule::in(ProductOrdersEnum::getValues())],
        ];

        foreach (ProductFiltersEnum::rules() as $filter => $rule) {
            $rules[$filter] = $rule;
        }

        return $rules;
    }
}
