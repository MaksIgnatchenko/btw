<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 22.10.2018
 */

namespace App\Modules\Users\Merchant\Facades;

use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Support\Facades\Facade;

class Geography extends Facade
{
    protected const DEFAULT_CITY_RESULT = ['Cities'];
    protected const DEFAULT_STATE_RESULT = ['States'];

    protected static function getFacadeAccessor()
    {
        return GeographyServiceInterface::class;
    }

    public static function getStatesByCountryAsSelectArray(int $country = null)
    {
        $states = static::getFacadeRoot()->getStates($country)->pluck('name', 'id');

        return $states->count() ? $states : self::DEFAULT_STATE_RESULT;
    }

    public static function getCitiesByStateAsSelectArray(int $state = null)
    {
        $cities = static::getFacadeRoot()->getCities($state)->pluck('name', 'id');

        return $cities->count() ? $cities : self::DEFAULT_CITY_RESULT;
    }
}