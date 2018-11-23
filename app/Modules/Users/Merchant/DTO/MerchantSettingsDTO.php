<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 22.11.2018
 */

namespace App\Modules\Users\Merchant\DTO;

use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;

class MerchantSettingsDTO
{
    /** @var array */
    protected $countries;

    /** @var array */
    protected $states;

    /** @var array */
    protected $cities;

    /** @var array */
    protected $categories;

    /** @var array */
    protected $storeCategories;

    /** @var GeographyCountry */
    protected $merchantCountry;

    /** @var GeographyCountry */
    protected $merchantStoreCountry;

    /** @var int */
    protected $merchantStateId;

    /** @var int */
    protected $merchantCityId;

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @param array $countries
     *
     * @return MerchantSettingsDTO
     */
    public function setCountries(array $countries): self
    {
        $this->countries = $countries;

        return $this;
    }

    /**
     * @return array
     */
    public function getStates(): array
    {
        return $this->states;
    }

    /**
     * @param array $states
     *
     * @return MerchantSettingsDTO
     */
    public function setStates(array $states): self
    {
        $this->states = $states;

        return $this;
    }

    /**
     * @return array
     */
    public function getCities(): array
    {
        return $this->cities;
    }

    /**
     * @param array $cities
     *
     * @return MerchantSettingsDTO
     */
    public function setCities(array $cities): self
    {
        $this->cities = $cities;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     *
     * @return MerchantSettingsDTO
     */
    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return array
     */
    public function getStoreCategories(): array
    {
        return $this->storeCategories;
    }

    /**
     * @param array $storeCategories
     *
     * @return MerchantSettingsDTO
     */
    public function setStoreCategories(array $storeCategories): self
    {
        $this->storeCategories = $storeCategories;

        return $this;
    }

    /**
     * @return GeographyCountry
     */
    public function getMerchantCountry(): GeographyCountry
    {
        return $this->merchantCountry;
    }

    /**
     * @param GeographyCountry $merchantCountry
     *
     * @return MerchantSettingsDTO
     */
    public function setMerchantCountry(GeographyCountry $merchantCountry): self
    {
        $this->merchantCountry = $merchantCountry;

        return $this;
    }

    /**
     * @return GeographyCountry
     */
    public function getMerchantStoreCountry(): GeographyCountry
    {
        return $this->merchantStoreCountry;
    }

    /**
     * @param GeographyCountry $merchantStoreCountry
     *
     * @return MerchantSettingsDTO
     */
    public function setMerchantStoreCountry(GeographyCountry $merchantStoreCountry): self
    {
        $this->merchantStoreCountry = $merchantStoreCountry;

        return $this;
    }

    /**
     * @return int
     */
    public function getMerchantStateId(): int
    {
        return $this->merchantStateId;
    }

    /**
     * @param int $merchantStateId
     *
     * @return MerchantSettingsDTO
     */
    public function setMerchantStateId(int $merchantStateId): self
    {
        $this->merchantStateId = $merchantStateId;

        return $this;
    }

    /**
     * @return int
     */
    public function getMerchantCityId(): int
    {
        return $this->merchantCityId;
    }

    /**
     * @param int $merchantCityId
     *
     * @return MerchantSettingsDTO
     */
    public function setMerchantCityId(int $merchantCityId): self
    {
        $this->merchantCityId = $merchantCityId;

        return $this;
    }
}
