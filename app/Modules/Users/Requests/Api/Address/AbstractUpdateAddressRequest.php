<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Requests\Api\Address;

use Illuminate\Foundation\Http\FormRequest;

class AbstractUpdateAddressRequest extends FormRequest
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'address'   => 'required|string|max:2000',
            'longitude' => 'required|numeric',
            'latitude'  => 'required|numeric',
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