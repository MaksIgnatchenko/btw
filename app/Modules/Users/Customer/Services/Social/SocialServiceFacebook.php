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

    const fields = 'id,first_name,last_name,name,gender,email,birthday,location';

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
            'appId' => env('FACEBOOK_CLIENT_ID'),
            'appSecret' => env('FACEBOOK_CLIENT_SECRET'),
        ];

        $this->fbApp = new FacebookApp($this->credentials['appId'], $this->credentials['appSecret']);
    }

    /**
     * @return array
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getUserData(): array
    {
        $fbRequest = new FacebookRequest($this->fbApp, $this->token, 'GET', '/me?fields=' . $this::fields);

        $client = new FacebookClient();

        $response = $client->sendRequest($fbRequest);

        return $response->getDecodedBody();
    }
}
