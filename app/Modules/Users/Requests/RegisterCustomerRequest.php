<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\RequestsTraits\UserValidationRulesTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
{
    use UserValidationRulesTrait;

    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|min:1|max:50',
            'last_name'  => 'required|min:1|max:50',
        ];

        return $this->getRegisterUserValidationRules() + $rules;
    }

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
    public function messages(): array
    {
        return [
            'password.regex' => 'Password should continue at least 1 digit, 1 letter and 1 special symbol',
        ];
    }
}
