<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.10.2018
 */

namespace App\Modules\Users\Customer\Factories;

use App\Modules\Users\Customer\DTO\SocialServiceDto;
use App\Modules\Users\Customer\Enums\SocialServiceEnum;
use App\Modules\Users\Customer\Exceptions\SocialServiceFactoryException;
use App\Modules\Users\Customer\Services\Social\SocialServiceFacebook;
use App\Modules\Users\Customer\Services\Social\SocialServiceGoogle;

class SocialServiceFactory
{

    /**
     * @param $service
     * @param SocialServiceDto $socialService
     * @return SocialServiceFacebook|SocialServiceGoogle
     * @throws SocialServiceFactoryException
     */
    public static function getSocialServiceInstance($service, SocialServiceDto $socialService)
    {
        switch ($service) {
            case SocialServiceEnum::SERVICE_FACEBOOK:
                $service = app(SocialServiceFacebook::class);
                $service->setData([
                    'token' => $socialService->getToken()
                ]);
                return $service;
            case  SocialServiceEnum::SERVICE_GOOGLE:
                $service = app(SocialServiceGoogle::class);
                $service->setData([
                    'token' => $socialService->getToken(),
                    'device' => $socialService->getDevice(),
                ]);
                return $service;
            default:
                throw new SocialServiceFactoryException("Illegal service name: $service");
        }
    }

}
