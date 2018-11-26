<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 22.11.2018
 */

namespace App\Modules\Users\Merchant\Helpers;

use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Users\Merchant\DTO\MerchantSettingsDTO;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;

abstract class SettingsControllerHelper
{
    /**
     * @param Merchant $merchant
     *
     * @return MerchantSettingsDTO
     */
    public static function getMerchantSettingsData(Merchant $merchant): MerchantSettingsDTO
    {
        /** @var GeographyServiceInterface $geographyService */
        $geographyService = app(GeographyServiceInterface::class);

        $merchantCountry = $geographyService->getCountryByShortName($merchant->address->country);
//        $merchant->phone = str_replace($merchantCountry->phoneCode, '', $merchant->phone);

        $merchantStateId = $geographyService
            ->getStateByName($merchant->address->state, $merchantCountry->id)->id;

        if (!empty($merchant->address->city)) {
            $merchantCityId = $geographyService
                ->getCityByName($merchant->address->city, $merchantStateId)->id;

            $cities = $geographyService
                ->getCities($merchantStateId)->pluck('name', 'id')->toArray();
        }

        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app(CategoryRepository::class);

        $disabledStoreCategories = $merchant->store->categories()
            ->whereHas('products')
            ->pluck('name', 'categories.id')->toArray();

        return (new MerchantSettingsDTO())
            ->setCountries($geographyService->getCountries()->pluck('name', 'id')->toArray())
            ->setStates($geographyService->getStates($merchantCountry->id)->pluck('name', 'id')->toArray())
            ->setCities($cities ?? [])
            ->setStoreCategories($merchant->store->categories->pluck('id')->toArray())
            ->setStoreDisabledCategories($disabledStoreCategories)
            ->setCategories($categoryRepository->findRootCategories()->pluck('name', 'id')->toArray())
            ->setMerchantStoreCountry($geographyService->getCountryByShortName($merchant->store->country))
            ->setMerchantCountry($merchantCountry)
            ->setMerchantStateId($merchantStateId)
            ->setMerchantCityId($merchantCityId ?? null);
    }
}
