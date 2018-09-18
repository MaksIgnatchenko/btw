<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.02.2018
 */

namespace App\Modules\Users\Dto;

use Illuminate\Support\Collection;

class HomeStatisticDto
{
    /** @var Collection */
    protected $merchantMarkers;
    /** @var int */
    protected $pendingMerchantsCount;
    /** @var int */
    protected $merchantsCount;
    /** @var Collection */
    protected $productsStatistic;
    /** @var int */
    protected $productsCount;
    /** @var int */
    protected $reviewsToApproveCount;
    /** @var float */
    protected $overallIncome;

    /**
     * @return Collection
     */
    public function getMerchantMarkers(): Collection
    {
        return $this->merchantMarkers;
    }

    /**
     * @param Collection $merchantMarkers
     *
     * @return HomeStatisticDto
     */
    public function setMerchantMarkers(Collection $merchantMarkers): HomeStatisticDto
    {
        $this->merchantMarkers = $merchantMarkers;

        return $this;
    }

    /**
     * @return int
     */
    public function getPendingMerchantsCount(): int
    {
        return $this->pendingMerchantsCount;
    }

    /**
     * @param int $pendingMerchantsCount
     *
     * @return HomeStatisticDto
     */
    public function setPendingMerchantsCount(int $pendingMerchantsCount): HomeStatisticDto
    {
        $this->pendingMerchantsCount = $pendingMerchantsCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getMerchantsCount(): int
    {
        return $this->merchantsCount;
    }

    /**
     * @param int $merchantsCount
     *
     * @return HomeStatisticDto
     */
    public function setMerchantsCount(int $merchantsCount): HomeStatisticDto
    {
        $this->merchantsCount = $merchantsCount;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductsStatistic(): Collection
    {
        return $this->productsStatistic;
    }

    /**
     * @param Collection $productsStatistic
     *
     * @return HomeStatisticDto
     */
    public function setProductsStatistic(Collection $productsStatistic): HomeStatisticDto
    {
        $this->productsStatistic = $productsStatistic;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductsCount(): int
    {
        return $this->productsCount;
    }

    /**
     * @param int $productsCount
     *
     * @return HomeStatisticDto
     */
    public function setProductsCount(int $productsCount): HomeStatisticDto
    {
        $this->productsCount = $productsCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getReviewsToApproveCount(): int
    {
        return $this->reviewsToApproveCount;
    }

    /**
     * @param int $reviewsToApproveCount
     *
     * @return HomeStatisticDto
     */
    public function setReviewsToApproveCount(int $reviewsToApproveCount): HomeStatisticDto
    {
        $this->reviewsToApproveCount = $reviewsToApproveCount;

        return $this;
    }

    /**
     * @return float
     */
    public function getOverallIncome(): float
    {
        return $this->overallIncome;
    }

    /**
     * @param float $overallIncome
     *
     * @return HomeStatisticDto
     */
    public function setOverallIncome(float $overallIncome): HomeStatisticDto
    {
        $this->overallIncome = $overallIncome;

        return $this;
    }
}
