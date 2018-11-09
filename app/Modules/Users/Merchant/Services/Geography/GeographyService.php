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
     * @param int|null $country
     *
     * @return Collection
     */
    public function getStates(int $country = null): Collection
    {
        if ($country) {
            return GeographyState::where('country_id', $country)->get();
        }

        return GeographyState::all();
    }

    /**
     * @param int|null $state
     *
     * @return Collection
     */
    public function getCities(int $state = null): Collection
    {
        if ($state) {
            return GeographyCity::where('state_id', $state)->get();
        }

        return GeographyState::all();
    }

    /**
     * @param string   $name
     * @param int|null $state
     *
     * @return GeographyCity
     */
    public function getCityByName(string $name, int $state = null): GeographyCity
    {
        $cities = (new GeographyCity)->newQuery();

        if($state) {
            $cities->where('state_id', $state);
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
     * @param int|null $country
     *
     * @return GeographyState
     */
    public function getStateByName(string $name, int $country = null): GeographyState
    {
        $states = (new GeographyState)->newQuery();

        if($states) {
            $states->where('country_id', $country);
        }

        return $states->where('name', $name)->firstOrFail();
    }
}