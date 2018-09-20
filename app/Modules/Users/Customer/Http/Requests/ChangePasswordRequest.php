<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\Models\User;
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
            'old_password' => 'required|min:8|max:50|regex:' . User::PASSWORD_REGEXP,
            'new_password' => 'required|min:8|max:50|regex:' . User::PASSWORD_REGEXP,
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'old_password.regex' => 'Invalid format. Password should contain at least 8 symbols of combination of digits and characters and special characters',
            'new_password.regex' => 'Invalid format. Password should contain at least 8 symbols of combination of digits and characters and special characters'
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
