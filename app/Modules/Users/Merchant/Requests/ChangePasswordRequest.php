<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Requests;

use App\Modules\Users\Http\Requests\ChangePasswordRequestAbstract;
use App\Modules\Users\Merchant\Rules\PasswordRule;

class ChangePasswordRequest extends ChangePasswordRequestAbstract
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules['old_password'] = array_merge($rules['old_password'],
            [
                new PasswordRule(),
            ]
        );

        $rules['new_password'] = array_merge($rules['new_password'],
            [
                'confirmed',
                new PasswordRule(),
            ]
        );

        return $rules;
    }
}