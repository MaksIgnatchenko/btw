<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Services\Geography;

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
            return GeographyState::where('state_id', $state)->get();
        }

        return GeographyState::all();
    }
}