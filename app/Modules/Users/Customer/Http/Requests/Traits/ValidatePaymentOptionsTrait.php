<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */


namespace App\Modules\Users\RequestsTraits;


use App\Modules\Users\Enums\PaymentOptionsEnum;

trait ValidatePaymentOptionsTrait
{
    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance(): \Illuminate\Contracts\Validation\Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('paypal_email', 'required|email', function ($input) {
            return PaymentOptionsEnum::PAYPAL === $input->payment_option;
        });
        $validator->sometimes('wire_account_name', 'required|min:1|max:100', function ($input) {
            return PaymentOptionsEnum::WIRE === $input->payment_option;
        });
        $validator->sometimes('wire_account_number', 'required|digits_between:1,50', function ($input) {
            return PaymentOptionsEnum::WIRE === $input->payment_option;
        });
        $validator->sometimes('wire_bank_name', 'required|min:1|max:100', function ($input) {
            return PaymentOptionsEnum::WIRE === $input->payment_option;
        });
        $validator->sometimes('wire_aba_number', 'required|regex:/\b\d{9}\b/', function ($input) {
            return PaymentOptionsEnum::WIRE === $input->payment_option;
        });

        return $validator;
    }
}