<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.11.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\User;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $user->save();
    }

    /**
     * @param string $name
     *
     * @return User|null
     */
    public function findByUsername(string $name): ?User
    {
        return User::find(['username' => $name]);
    }

    /**
     * @return Collection
     */
    public function getPushEnabledUsers(): Collection
    {
        return User::whereHas('userSetting', function ($query) {
            $query->where('settings->push', true);
        })
            ->with('device')
            ->get();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
