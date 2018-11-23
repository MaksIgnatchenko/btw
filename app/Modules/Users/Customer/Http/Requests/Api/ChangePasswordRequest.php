<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Customer\Http\Requests\Api;

use App\Modules\Users\Http\Requests\ChangePasswordRequestAbstract;
use App\Rules\PasswordRule;

class ChangePasswordRequest extends ChangePasswordRequestAbstract
{
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            'old_password' => [
                new PasswordRule(),
            ],
            'new_password' => [
                new PasswordRule(),
            ],
        ];
    }
}
