<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\UserSettings;
use Prettus\Repository\Eloquent\BaseRepository;

class UserSettingsRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return UserSettings::class;
    }

    /**
     * @param int $userId
     *
     * @return UserSettings|null
     */
    public function findByUserId(int $userId): ?UserSettings
    {
        return UserSettings::where('user_id', '=', $userId)->first();
    }

    /**
     * @param UserSettings $userSettings
     */
    public function save(UserSettings $userSettings): void
    {
        $userSettings->save();
    }
}
