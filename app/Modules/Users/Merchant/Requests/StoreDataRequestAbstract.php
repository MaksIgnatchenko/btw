<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataRequestAbstract extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'store_country' => 'required|integer',
            'store_city' => 'required|string|max:255',
            'info' => 'required|string|max:5000',
            'categories' => 'required|array',
            'categories.*' => 'int|exists:categories,id',
        ];
    }
}
