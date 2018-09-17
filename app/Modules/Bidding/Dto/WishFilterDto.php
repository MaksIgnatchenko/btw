<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 31.01.2018
 */

namespace App\Modules\Bidding\Dto;

class WishFilterDto
{
    /** @var string */
    protected $filter;
    /** @var int */
    protected $categoryId;
    /** @var float */
    protected $longitude;
    /** @var float */
    protected $latitude;
    /** @var int */
    protected $distance;
    /** @var string */
    protected $barcode;
    /** @var string */
    protected $name;
    /** @var int */
    protected $offset;

    /**
     * WishFilterDto constructor.
     *
     * @param string $filter
     */
    public function __construct(string $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId |null
     *
     * @return WishFilterDto
     */
    public function setCategoryId(int $categoryId = null): WishFilterDto
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     * @param float|null $longitude
     *
     * @return WishFilterDto
     */
    public function setCoordinates(float $latitude = null, float $longitude = null): WishFilterDto
    {
        $this->latitude = $latitude;
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
     * @param string $barcode
     *
     * @return WishFilterDto
     */
    public function setBarcode(string $barcode = null): WishFilterDto
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return WishFilterDto
     */
    public function setName(string $name = null): WishFilterDto
    {
        $this->name = $name;

        return $this;
    }

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
     * @return WishFilterDto
     */
    public function setOffset(int $offset): WishFilterDto
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     *
     * @return WishFilterDto
     */
    public function setDistance(int $distance = null): WishFilterDto
    {
        $this->distance = $distance;

        return $this;
    }
}
