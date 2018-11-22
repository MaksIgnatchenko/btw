<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Services\Geography;

use App\Modules\Users\Merchant\Models\Geography\GeographyCity;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;
use Illuminate\Database\Eloquent\Collection;

class GeographyService implements GeographyServiceInterface
{

    /**
     * @return GeographyCountry[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCountries(): Collection
    {
        return GeographyCountry::all();
    }

    /**
     * @param $id
     *
     * @return GeographyCountry
     */
    public function getCountryById($id): GeographyCountry
    {
        return GeographyCountry::findOrFail($id);
    }

    /**
     * @param int|null $countryId
     *
     * @return Collection
     */
    public function getStates(int $countryId = null): Collection
    {
        if ($countryId) {
            return GeographyState::where('country_id', $countryId)->get();
        }

        return GeographyState::all();
    }

    /**
     * @param int|null $stateId
     *
     * @return Collection
     */
    public function getCities(int $stateId = null): Collection
    {
        if ($stateId) {
            return GeographyCity::where('state_id', $stateId)->get();
        }

        return GeographyState::all();
    }

    /**
     * @param string   $name
     * @param int|null $stateId
     *
     * @return GeographyCity
     */
    public function getCityByName(string $name, int $stateId = null): GeographyCity
    {
        $cities = (new GeographyCity)->newQuery();

        if($stateId) {
            $cities->where('state_id', $stateId);
        }

        return $cities->where('name', $name)->firstOrFail();
    }

    /**
     * @param string $shortName
     *
     * @return GeographyCountry|null
     */
    public function getCountryByShortName(string $shortName): GeographyCountry
    {
        return GeographyCountry::where('sortname', $shortName)->firstOrFail();
    }

    /**
     * @param string   $name
     * @param int|null $countryId
     *
     * @return GeographyState
     */
    public function getStateByName(string $name, int $countryId = null): GeographyState
    {
        $states = (new GeographyState)->newQuery();

        if($states) {
            $states->where('country_id', $countryId);
        }

        return $states->where('name', $name)->firstOrFail();
    }
}