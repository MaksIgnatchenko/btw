<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

namespace App\Modules\Users\RequestsTraits;

use App\Modules\Users\Models\User;

trait PasswordRulesTrait
{
    /**
     * @return array
     */
    protected function getPasswordRules(): array
    {
        return [
            'password' => 'required|min:8|max:50|regex:' . User::PASSWORD_REGEXP,
        ];
    }
}
