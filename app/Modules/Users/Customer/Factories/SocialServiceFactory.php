<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Factories;

use App\Modules\Users\Customer\Exceptions\SocialServiceFactoryException;
use App\Modules\Users\Customer\Services\Social\SocialServiceFacebook;
use App\Modules\Users\Customer\Services\Social\SocialServiceGoogle;

class SocialServiceFactory
{
    protected $socialServiceInstance;

    /**
     * @param $service
     * @param $token
     *
     * @return SocialServiceFacebook|SocialServiceGoogle
     * @throws SocialServiceFactoryException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getSocialServiceInstance($service, $token)
    {
        switch ($service) {
            case 'facebook':
                $this->socialServiceInstance = new SocialServiceFacebook($token);
                break;
            case 'google':
                $this->socialServiceInstance = new SocialServiceGoogle($token);
                break;
            default:
                throw new SocialServiceFactoryException("Illegal service name: $service");
        }

        return $this->socialServiceInstance;
    }

}
