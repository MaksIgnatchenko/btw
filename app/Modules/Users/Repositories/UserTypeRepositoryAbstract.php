<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\UserTypeAbstract;
use InfyOm\Generator\Common\BaseRepository;

abstract class UserTypeRepositoryAbstract extends BaseRepository
{
    /**
     * @param UserTypeAbstract $model
     */
    public function save(UserTypeAbstract $model): void
    {
        $model->save();
    }
}
