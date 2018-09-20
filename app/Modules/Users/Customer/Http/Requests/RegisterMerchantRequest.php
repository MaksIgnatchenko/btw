<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\Enums\PaymentOptionsEnum;
use App\Modules\Users\RequestsTraits\UserValidationRulesTrait;
use App\Modules\Users\RequestsTraits\ValidatePaymentOptionsTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterMerchantRequest extends FormRequest implements ModifyPaymentOptionsRequestInterface
{
    use UserValidationRulesTrait;
    use ValidatePaymentOptionsTrait;

    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'business_name'  => 'required|min:1|max:100',
            'telephone'      => 'required|digits:10',
            'ein'            => 'required|regex:/\b\d{9}\b/',
            'contact'        => 'required|min:1|max:100',
            'check'          => 'required|bool',
            'categories'     => 'required|array',
            'categories.*'   => 'required|exists:categories,id',
            'payment_option' => 'required|in:' . implode(',', PaymentOptionsEnum::getValues()),

            'longitude' => 'required|numeric',
            'latitude'  => 'required|numeric',
            'address'   => 'required|string|max:2000',
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

    /**
     * @return array
     */
    public function messages(): array
    {
        $messages = [];

        $messages['wire_aba_number.regex'] = 'ABA number should contain 9 digits';
        $messages['ein.regex'] = 'EIN number should contain 9 digits';

        return $messages;
    }
}
