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
            'email' => 'sometimes|required|min:1|max:100|unique:merchants,email',
            'password' => 'sometimes|required|min:6|max:50',
            'store' => 'sometimes|required|min:3|max:50',
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
