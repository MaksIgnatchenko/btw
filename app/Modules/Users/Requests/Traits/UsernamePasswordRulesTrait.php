<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.11.2017
 */

namespace App\Modules\Users\RequestsTraits;

trait UsernamePasswordRulesTrait
{
    use PasswordRulesTrait;

    /**
     * @return array
     */
    protected function getUsernamePasswordRules(): array
    {
        $rules = [
            'username' => 'required|alpha_num|min:6|max:50|unique:users,username',
        ];

        return $this->getPasswordRules() + $rules;
    }
}
