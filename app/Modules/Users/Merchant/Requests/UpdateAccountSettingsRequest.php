<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 14.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAccountSettingsRequest extends ContactDataRequestAbstract
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return parent::rules() + [
            'email' => 'required|email|max:255|' . Rule::unique('merchants')->ignore(Auth::id()),
        ];
    }
}
