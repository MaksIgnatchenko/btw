<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 29.03.2018
 */

namespace App\Modules\Products\Dto;

class CoordinatesDto
{
    /** @var float */
    protected $longitude;
    /** @var float */
    protected $latitude;

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return CoordinatesDto
     */
    public function setLongitude(float $longitude): CoordinatesDto
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return CoordinatesDto
     */
    public function setLatitude(float $latitude): CoordinatesDto
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        if (0.0 === $this->longitude && 0.0 === $this->latitude) {
            return true;
        }

        return false;
    }
}
