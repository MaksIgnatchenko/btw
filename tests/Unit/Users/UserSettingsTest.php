<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 29.11.2017
 */

namespace Tests\Unit\Users;

use App\Modules\Users\Models\UserSettings;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    public function testSetSettings()
    {
        $userSettings = new UserSettings();
        $this->assertEquals([], $userSettings->settings);

        $userSettings->setSetting('push', true);
        $this->assertEquals(true, $userSettings->settings['push']);

        $userSettings->setSetting('other setting', false);
        $this->assertEquals(true, $userSettings->settings['push']);
        $this->assertEquals(false, $userSettings->settings['other setting']);
    }
}
