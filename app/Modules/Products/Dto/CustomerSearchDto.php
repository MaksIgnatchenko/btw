<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.12.2017
 */

namespace App\Modules\Products\Dto;

class CustomerSearchDto
{
    /** @var int */
    protected $offset;
    /** @var int */
    protected $distance;
    /** @var int */
    protected $categoryId;
    /** @var string */
    protected $keyword;
    /** @var float */
    protected $latitude;
    /** @var float */
    protected $longitude;
    /** @var string */
    protected $barcode;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return CustomerSearchDto
     */
    public function setOffset($offset): CustomerSearchDto
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     *
     * @return CustomerSearchDto
     */
    public function setDistance(int $distance): CustomerSearchDto
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     *
     * @return CustomerSearchDto
     */
    public function setCategoryId(int $categoryId = null): CustomerSearchDto
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     *
     * @return CustomerSearchDto
     */
    public function setKeyword(string $keyword = null): CustomerSearchDto
    {
        $this->keyword = $keyword;

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
     * @return CustomerSearchDto
     */
    public function setLatitude(float $latitude): CustomerSearchDto
    {
        $this->latitude = $latitude;

        return $this;
    }

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
     * @return CustomerSearchDto
     */
    public function setLongitude(float $longitude): CustomerSearchDto
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string|null $barcode
     *
     * @return CustomerSearchDto
     */
    public function setBarcode(string $barcode = null): CustomerSearchDto
    {
        $this->barcode = $barcode;

        return $this;
    }
}
