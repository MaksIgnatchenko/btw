<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Services\Geography;

interface GeographyServiceInterface
{
    public function getCountries();

    public function getCountryById($id);

    public function getStates(int $country = null);

    public function getCities(int $state = null);
}