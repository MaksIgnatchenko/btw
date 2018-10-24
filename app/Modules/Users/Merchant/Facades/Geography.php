<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 22.10.2018
 */

namespace App\Modules\Users\Merchant\Facades;

use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Support\Facades\Facade;

class Geography extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GeographyServiceInterface::class;
    }

    public static function getStatesByCountryAsSelectArray(int $country = null)
    {
        $states = static::getFacadeRoot()->getStates($country)->pluck('name', 'id');

        return $states->count() ? $states : [__('registration.contacts.state')];
    }

    public static function getCitiesByStateAsSelectArray(int $state = null)
    {
        $cities = static::getFacadeRoot()->getCities($state)->pluck('name', 'id');

        return $cities->count() ? $cities : [__('registration.contacts.city')];
    }
}