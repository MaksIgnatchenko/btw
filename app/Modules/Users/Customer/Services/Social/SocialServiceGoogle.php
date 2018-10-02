<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Services\Social;

use App\Helpers\ArrayHelper;
use App\Modules\Users\Customer\Exceptions\SocialServiceException;
use App\Modules\Users\Customer\Exceptions\SocialServiceGoogleException;
use App\Modules\Users\Customer\Services\SocialServiceInterface;

class SocialServiceGoogle extends SocialServiceAbstract implements SocialServiceInterface
{
    protected const KEYS_TO_REPLACE = [
        'given_name' => 'first_name',
        'family_name' => 'last_name',
    ];

    protected $client;

    public function __construct($token)
    {
        parent::__construct($token);

        $this->credentials = [
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
        ];

        $this->client = new \Google_Client($this->credentials);
    }

    /**
     * @return array
     * @throws SocialServiceException
     */
    public function getUserData(): array
    {
        $payload = $this->client->verifyIdToken($this->token);

        if ($payload) {
            return ArrayHelper::replace_keys($payload, self::KEYS_TO_REPLACE);
        }

        throw new SocialServiceGoogleException("Token ID verification failed");
    }
}
