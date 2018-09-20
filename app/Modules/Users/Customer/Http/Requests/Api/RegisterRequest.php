<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.11.2017
 */

namespace App\Modules\Users\Customer\Http\Api\Requests;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'email' => 'required|email|max:100|unique:customer',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'max:50',
                new PasswordRule(),
            ]
        ];
    }
}
