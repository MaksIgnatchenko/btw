<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-14
 * Time: 15:55
 */

namespace App\Modules\Users\Customer\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeliveryInformationRequest extends FormRequest
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
            'country' => [
                'required',
                Rule::in(['USA']),
            ],
            'street' => 'required|string|max:100',
            'apartment' => 'nullable|string|min:2|max:100',
            'city' => 'required|string|min:2|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|digits:5',
            'notes' => 'nullable|string|max:100',
            'phone' => 'required|digits:11',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'country.in' => 'Wrong value. Available values: USA'
        ];
    }
}