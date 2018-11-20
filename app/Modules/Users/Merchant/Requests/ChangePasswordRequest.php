<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use App\Modules\Users\Merchant\Rules\PasswordRule;
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
                'confirmed',
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