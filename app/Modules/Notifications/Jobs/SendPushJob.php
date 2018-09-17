<?php

namespace App\Modules\Notifications\Jobs;

use Edujugon\PushNotification\PushNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

abstract class SendPushJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var array */
    protected $tokens;
    /** @var array */
    protected $messageParams;
    /** @var string */
    protected $platform;

    /**
     * SendPushJob constructor.
     *
     * @param array $tokens
     */
    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }

    public function handle(): void
    {
        $push = new PushNotification($this->platform);

        $push->setMessage($this->messageParams)->setDevicesToken($this->tokens)->send();
    }
}
