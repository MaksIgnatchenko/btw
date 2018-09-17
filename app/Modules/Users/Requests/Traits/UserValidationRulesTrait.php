<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Users\RequestsTraits;

trait UserValidationRulesTrait
{
    use UsernamePasswordRulesTrait;

    /**
     * @return array
     */
    protected function getRegisterUserValidationRules(): array
    {
        $rules = [
            'email' => 'required|unique:users,email|email|max:100'
        ];

        return $this->getUsernamePasswordRules() + $rules;
    }
}
