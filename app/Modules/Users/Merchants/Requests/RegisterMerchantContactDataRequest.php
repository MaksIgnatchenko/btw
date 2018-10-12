<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchants\Requests;

use App\Modules\Users\Merchants\Enums\MerchantRegistrationCountriesEnum;
use App\Modules\Users\Merchants\Rules\CountryZipCodeRule;
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
            'street_adress' => 'required|string|max:255',
            'country' => 'required|string|' . Rule::in(MerchantRegistrationCountriesEnum::toArray()),
            'state' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => new CountryZipCodeRule($this->country),
            'phone_code' => '',
            'phone_number' => '',
            'products' => 'required|array',
            'products.*' => 'int|exists:categories',
        ];
    }
}