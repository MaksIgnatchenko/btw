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
     * @param int|null $country
     *
     * @return Collection
     */
    public function getStates(int $country = null): Collection;

    /**
     * @param int|null $state
     *
     * @return Collection
     */
    public function getCities(int $state = null): Collection;

    /**
     * @param string $shortName
     *
     * @return GeographyCountry|null
     */
    public function getCountryByShortName(string $shortName): GeographyCountry;

    /**
     * @param string   $name
     * @param int|null $country
     *
     * @return GeographyState
     */
    public function getStateByName(string $name, int $country = null): GeographyState;

    /**
     * @param string   $name
     * @param int|null $state
     *
     * @return GeographyCity
     */
    public function getCityByName(string $name, int $state = null): GeographyCity;

}