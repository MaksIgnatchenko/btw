<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 27.9.2018
 */

namespace App\Modules\Users\Customer\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginSocialRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'token' => 'required|string',
            'device' => [
                'regex:/^(ios|android)$/',
                'required'
            ],
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