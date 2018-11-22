<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Services\Geography;

use App\Modules\Users\Merchant\Models\Geography\GeographyCity;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;
use Illuminate\Database\Eloquent\Collection;

interface GeographyServiceInterface
{
    /**
     * @return Collection
     */
    public function getCountries(): Collection;

    /**
     * @param $id
     *
     * @return GeographyCountry
     */
    public function getCountryById($id): GeographyCountry;

    /**
     * @param int|null $countryId
     *
     * @return Collection
     */
    public function getStates(int $countryId = null): Collection;

    /**
     * @param int|null $stateId
     *
     * @return Collection
     */
    public function getCities(int $stateId = null): Collection;

    /**
     * @param string $shortName
     *
     * @return GeographyCountry|null
     */
    public function getCountryByShortName(string $shortName): GeographyCountry;

    /**
     * @param string   $name
     * @param int|null $countryId
     *
     * @return GeographyState
     */
    public function getStateByName(string $name, int $countryId = null): GeographyState;

    /**
     * @param string   $name
     * @param int|null $stateId
     *
     * @return GeographyCity
     */
    public function getCityByName(string $name, int $stateId = null): GeographyCity;

}