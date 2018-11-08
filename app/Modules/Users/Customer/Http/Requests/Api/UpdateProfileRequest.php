<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 2.11.2018
 */

namespace App\Modules\Users\Customer\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'sometimes|required|min:2|max:50',
            'last_name' => 'sometimes|required|min:2|max:50',
            'email' => 'sometimes|required|email|max:100|unique:customers|unique:admins',
            'address' => 'sometimes|nullable|string|max:255',
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
