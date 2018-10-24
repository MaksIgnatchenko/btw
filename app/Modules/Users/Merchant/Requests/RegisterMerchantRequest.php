<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Users\Requests;

use App\Modules\Users\Merchant\Rules\CountryZipCodeRule;
use App\Modules\Users\Merchant\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterMerchantRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:merchants,email',
            'password' => 'required|min:6|max:50',
            'store' => 'required|string|min:3|max:100',
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
