<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 23.02.2018
 */

namespace App\Modules\Users\Admin\Dto;

class HomeStatisticDto
{
    /** @var iterable */
    protected $merchantMarkers;
    /** @var int */
    protected $pendingMerchantsCount = 0;
    /** @var int */
    protected $merchantsCount = 0;
    /** @var iterable */
    protected $productsStatistic = [];
    /** @var int */
    protected $productsCount = 0;
    /** @var int */
    protected $reviewsToApproveCount = 0;
    /** @var float */
    protected $overallIncome = 0.0;

    /**
     * @return iterable
     */
    public function getMerchantMarkers()
    {
        return $this->merchantMarkers;
    }

    /**
     * @param iterable $merchantMarkers
     *
     * @return HomeStatisticDto
     */
    public function setMerchantMarkers(iterable $merchantMarkers): HomeStatisticDto
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
     * @return iterable
     */
    public function getProductsStatistic(): iterable
    {
        return $this->productsStatistic;
    }

    /**
     * @param iterable $productsStatistic
     *
     * @return HomeStatisticDto
     */
    public function setProductsStatistic(iterable $productsStatistic): HomeStatisticDto
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
