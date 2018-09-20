<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Customer\Http\Requests\Api;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => [
                'required',
                'min:6',
                'max:50',
                new PasswordRule(),
            ],
            'new_password' => [
                'required',
                'min:6',
                'max:50',
                new PasswordRule(),
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
