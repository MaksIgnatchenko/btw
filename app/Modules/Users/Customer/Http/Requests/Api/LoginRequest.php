<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.11.2017
 */

namespace App\Modules\Users\Customer\Http\Api\Requests;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:100',
            'password' => [
                'required',
                'min:6',
                'max:50',
                new PasswordRule(),
            ]
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
