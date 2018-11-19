<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\Merchant\Rules\CountryZipCodeRule;
use App\Modules\Users\Merchant\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterMerchantRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:merchants,email',
            'password' => [
                'required',
                'min:6',
                'max:50',
                'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(.+)$/',
            ],
            'store' => 'required|string|min:3|max:100',
            'captcha' => 'required|' . Rule::in($this->session()->get('captcha')),
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
