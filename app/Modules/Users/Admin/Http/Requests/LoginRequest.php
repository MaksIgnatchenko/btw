<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.11.2017
 */

namespace App\Modules\Users\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:6|max:50',
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
