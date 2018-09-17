<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\User;

interface AddRoleEventInterface
{
    /**
     * @return User
     */
    public function getUser(): User;
}
