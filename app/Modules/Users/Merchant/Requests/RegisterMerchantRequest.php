<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\Enums\PaymentOptionsEnum;
use App\Modules\Users\RequestsTraits\UserValidationRulesTrait;
use App\Modules\Users\RequestsTraits\ValidatePaymentOptionsTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterMerchantRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'email' => 'required|min:1|max:100',
            'password' => 'required|digits:10',
            'ein' => 'required|regex:/\b\d{9}\b/',
        ];

        return array_merge($this->getRegisterUserValidationRules(), $rules);
    }


    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
