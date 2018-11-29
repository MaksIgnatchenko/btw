<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Services\Social;

use App\Modules\Users\Customer\Services\SocialServiceInterface;
use Facebook\FacebookApp;
use Facebook\FacebookClient;
use Facebook\FacebookRequest;

class SocialServiceFacebook extends SocialServiceAbstract implements SocialServiceInterface
{
    protected $fbApp;

    protected const FIELDS = 'id,first_name,last_name,email,picture';

    /**
     * SocialServiceFacebook constructor.
     *
     * @param $token
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct($token)
    {
        parent::__construct($token);

        $this->credentials = [
            'appId' => config('services.facebook.client_id'),
            'appSecret' => config('services.facebook.client_secret'),
        ];

        $this->fbApp = new FacebookApp($this->credentials['appId'], $this->credentials['appSecret']);
    }

    /**
     * @return array
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getUserData(): array
    {
        $fbRequest = new FacebookRequest($this->fbApp, $this->token, 'GET', '/me?fields=' . self::FIELDS);

        $client = new FacebookClient();

        $response = $client->sendRequest($fbRequest);

        return $response->getDecodedBody();
    }
}
