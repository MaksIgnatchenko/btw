<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Services\Geography;

use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;
use Illuminate\Support\Facades\DB;

class GeographyService implements GeographyServiceInterface
{
    protected const PATH = 'vendor/Countries-States-Cities-database/';

    public function getCountries()
    {
        return GeographyCountry::all();
    }

    public function getCountryById($id)
    {
        return GeographyCountry::findOrFail($id);
    }

    public function getStates(int $country = null)
    {
        if($country) {
            return GeographyState::where('country_id', $country);
        }

        return GeographyState::all();
    }

    public function getCities(int $state = null)
    {
        if($state) {
            return GeographyState::where('state_id', $state);
        }

        return GeographyState::all();
    }
}