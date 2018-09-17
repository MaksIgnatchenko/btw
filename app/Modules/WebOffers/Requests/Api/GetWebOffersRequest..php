<?php

namespace App\Modules\WebOffers\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GetWebOffersRequest extends FormRequest
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
            'name' => 'string|max:500',
            'upc'  => 'string|max:20',

            'category_id' => 'integer|exists:categories,id'
        ];
    }
}
