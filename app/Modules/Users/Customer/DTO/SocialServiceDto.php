<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 2.10.2018
 */

namespace App\Modules\Users\Customer\DTO;

class SocialServiceDto
{
    /** @var string */
    protected $token;

    /** @var string */
    protected $device;

    /**
     * SocialServiceDto constructor.
     *
     * @param string $token
     * @param string $device
     */
    public function __construct(string $token, string $device)
    {
        $this->token = $token;
        $this->device = $device;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getDevice()
    {
        return $this->device;
    }

    public function setToken(string $token): SocialServiceDto
    {
        $this->token = $token;

        return $this;
    }

    public function setDevice(string $device): SocialServiceDto
    {
        $this->device = $device;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'device' => $this->device,
        ];
    }
}
