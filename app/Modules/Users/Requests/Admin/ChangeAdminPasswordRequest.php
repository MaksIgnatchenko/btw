<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 19.12.2017
 */

namespace App\Modules\Users\Http\Requests\Admin;

use App\Modules\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangeAdminPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|regex:' . User::PASSWORD_REGEXP,
        ];
    }
}
