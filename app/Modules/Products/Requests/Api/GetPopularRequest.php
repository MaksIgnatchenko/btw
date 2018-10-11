<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 18.12.2017
 */

namespace App\Modules\Products\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetPopularRequest extends FormRequest
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
            'offset'    => 'sometimes|integer',
        ];
    }
}
