<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Services\Social;

use App\Helpers\ArrayHelper;
use App\Modules\Users\Customer\Exceptions\SocialServiceException;
use App\Modules\Users\Customer\Exceptions\SocialServiceGoogleException;
use App\Modules\Users\Customer\Services\SocialServiceInterface;
use GuzzleHttp\Client;

class SocialServiceGoogle extends SocialServiceAbstract implements SocialServiceInterface
{
    protected const GET_USER_DATA_REQUEST_URL = 'https://www.googleapis.com/oauth2/v1/userinfo';

    protected const KEYS_TO_REPLACE = [
        'given_name' => 'first_name',
        'family_name' => 'last_name',
    ];

    /**
     * @return array
     * @throws SocialServiceException
     */
    public function getUserData(): array
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . $this->token,
        ]]);

        $res = $client->get(self::GET_USER_DATA_REQUEST_URL);

        if (200 === $res->getStatusCode()) {
            $userData = json_decode($res->getBody()->getContents(), true);
            return ArrayHelper::replace_keys($userData, self::KEYS_TO_REPLACE);
        }

        throw new SocialServiceGoogleException("Response returned with code: {$res->getStatusCode()}");
    }
}
