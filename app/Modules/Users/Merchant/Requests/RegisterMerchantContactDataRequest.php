<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use App\Modules\Users\Merchant\Enums\MerchantRegistrationCountriesEnum;
use App\Modules\Users\Merchant\Rules\CountryZipCodeRule;
use App\Modules\Users\Merchant\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterMerchantContactDataRequest extends FormRequest
{
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
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'street' => 'required|string|max:255',
            'country' => 'required|integer|not_in:0',
            'state' => 'required|integer|not_in:0',
            'city' => 'nullable|string|max:255',
            'zipcode' => [
                'required',
                new CountryZipCodeRule($this->country)
            ],
            'phone_code' => ['sometimes', 'required'],
            'phone_number' => [
                'required',
                new PhoneNumberRule($this->country, $this->phone_code)
            ],
        ];
    }
}