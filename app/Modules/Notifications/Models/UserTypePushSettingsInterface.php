<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface UserTypePushSettingsInterface
{
    /**
     * @return PushSettingsInterface
     */
    public function getPushSettings(): PushSettingsInterface;

    /**
     * @return HasOne
     */
    public function pushSettings(): HasOne;

    /**
     * @param array $input
     */
    public function updatePushSettings(array $input);
}
