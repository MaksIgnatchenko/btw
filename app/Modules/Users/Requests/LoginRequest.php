<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\RequestsTraits\PasswordRulesTrait;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use PasswordRulesTrait;

    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'username'    => 'required|string|min:6|max:50',
        ];

        return array_merge($this->getPasswordRules(), $rules);
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
