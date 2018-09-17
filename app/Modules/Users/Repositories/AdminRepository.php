<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 19.12.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\Admin;
use InfyOm\Generator\Common\BaseRepository;

class AdminRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Admin::class;
    }

    /**
     * @param Admin $admin
     */
    public function save(Admin $admin): void
    {
        $admin->save();
    }
}
