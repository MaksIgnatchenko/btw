<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use App\Modules\Users\Merchant\Rules\CountryZipCodeRule;
use App\Modules\Users\Merchant\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

abstract class ContactDataRequestAbstract extends FormRequest
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
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'nullable|string|max:255',
            'zipcode' => [
                'required',
                new CountryZipCodeRule($this->country),
            ],
            'phone_code' => ['sometimes', 'required'],
            'phone_number' => [
                'required',
                new PhoneNumberRule($this->country, $this->phone_code),
            ],
        ];
    }
}
