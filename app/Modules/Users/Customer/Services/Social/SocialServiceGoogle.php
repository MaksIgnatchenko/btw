<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Services\Social;

use App\Modules\Users\Customer\Exceptions\SocialServiceException;
use App\Modules\Users\Customer\Services\SocialServiceInterface;
use GuzzleHttp\Client;

class SocialServiceGoogle extends SocialServiceAbstract implements SocialServiceInterface
{
    const getUserDataRequestUrl = 'https://www.googleapis.com/oauth2/v1/userinfo';

    /**
     * SocialServiceGoogle constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * @return array
     * @throws SocialServiceException
     */
    public function getUserData(): array
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . $this->token,
        ]]);

        $res = $client->get($this::getUserDataRequestUrl);

        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody()->getContents(), true);
        }

        throw new SocialServiceException("Response returned with code: {$res->getStatusCode()}");
    }
}
