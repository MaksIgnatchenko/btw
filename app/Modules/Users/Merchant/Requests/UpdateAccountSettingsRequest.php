<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 14.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use App\Modules\Users\Merchant\Rules\CountryZipCodeRule;
use App\Modules\Users\Merchant\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountSettingsRequest extends ContactDataRequestAbstract
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return parent::rules() + [
            'email' => 'required|email|max:255|unique:merchants,email',
        ];
    }
}
