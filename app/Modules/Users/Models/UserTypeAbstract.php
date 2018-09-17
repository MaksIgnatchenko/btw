<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laratrust\Traits\LaratrustUserTrait;

abstract class UserTypeAbstract extends Model
{
    use LaratrustUserTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
