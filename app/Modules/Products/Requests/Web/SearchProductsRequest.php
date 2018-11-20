<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 14.11.2018
 */

namespace App\Modules\Products\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
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
            'search' => 'required|string',
        ];
    }
}
