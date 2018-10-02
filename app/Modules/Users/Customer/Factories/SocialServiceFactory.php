<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Factories;

use App\Modules\Users\Customer\Enums\SocialServiceEnum;
use App\Modules\Users\Customer\Exceptions\SocialServiceFactoryException;
use App\Modules\Users\Customer\Services\Social\SocialServiceFacebook;
use App\Modules\Users\Customer\Services\Social\SocialServiceGoogle;

class SocialServiceFactory
{

    /**
     * @param $service
     * @param $token
     *
     * @return SocialServiceFacebook|SocialServiceGoogle
     * @throws SocialServiceFactoryException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public static function getSocialServiceInstance($service, $params)
    {
        switch ($service) {
            case SocialServiceEnum::SERVICE_FACEBOOK:
                return new SocialServiceFacebook($params['token']);
            case  SocialServiceEnum::SERVICE_GOOGLE:
                return new SocialServiceGoogle($params['token'], $params['device']);
            default:
                throw new SocialServiceFactoryException("Illegal service name: $service");
        }
    }

}
