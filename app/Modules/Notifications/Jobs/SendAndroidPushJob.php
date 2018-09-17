<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 14.12.2017
 */

namespace App\Modules\Notifications\Jobs;

use App\Modules\Notifications\Enums\PushPlatformsEnum;

class SendAndroidPushJob extends SendPushJob
{
    public function __construct(array $tokens, string $title, string $message)
    {
        parent::__construct($tokens);

        $this->platform = PushPlatformsEnum::ANDROID;

        $this->messageParams = [
            'notification' => [
                'title' => $title,
                'body'  => $message,
                'sound' => 'default',
            ]
        ];
    }
}
