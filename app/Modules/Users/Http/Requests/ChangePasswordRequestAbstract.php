<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 21.11.2018
 */

namespace App\Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class ChangePasswordRequestAbstract extends FormRequest
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
            ],
            'new_password' => [
                'required',
                'min:6',
                'max:50',
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
