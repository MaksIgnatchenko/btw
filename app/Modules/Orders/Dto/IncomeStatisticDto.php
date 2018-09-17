<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.01.2018
 */

namespace App\Modules\Orders\Dto;

class IncomeStatisticDto
{
    /** @var int */
    protected $count;
    /** @var float */
    protected $amount;
    /** @var int */
    protected $pending;
    /** @var int */
    protected $pickedUp;
    /** @var int */
    protected $refunded;
    /** @var int */
    protected $returned;
    /** @var int */
    protected $closed;

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return IncomeStatisticDto
     */
    public function setCount($count): IncomeStatisticDto
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return IncomeStatisticDto
     */
    public function setAmount(float $amount): IncomeStatisticDto
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return int
     */
    public function getPending(): int
    {
        return $this->pending;
    }

    /**
     * @param int $pending
     *
     * @return IncomeStatisticDto
     */
    public function setPending(int $pending): IncomeStatisticDto
    {
        $this->pending = $pending;

        return $this;
    }

    /**
     * @return int
     */
    public function getPickedUp(): int
    {
        return $this->pickedUp;
    }

    /**
     * @param int $pickedUp
     *
     * @return IncomeStatisticDto
     */
    public function setPickedUp(int $pickedUp): IncomeStatisticDto
    {
        $this->pickedUp = $pickedUp;

        return $this;
    }

    /**
     * @return int
     */
    public function getRefunded(): int
    {
        return $this->refunded;
    }

    /**
     * @param int $refunded
     *
     * @return IncomeStatisticDto
     */
    public function setRefunded(int $refunded): IncomeStatisticDto
    {
        $this->refunded = $refunded;

        return $this;
    }

    /**
     * @return int
     */
    public function getReturned(): int
    {
        return $this->returned;
    }

    /**
     * @param int $returned
     *
     * @return IncomeStatisticDto
     */
    public function setReturned(int $returned): IncomeStatisticDto
    {
        $this->returned = $returned;

        return $this;
    }

    /**
     * @return int
     */
    public function getClosed(): int
    {
        return $this->closed;
    }

    /**
     * @param int $closed
     *
     * @return IncomeStatisticDto
     */
    public function setClosed(int $closed): IncomeStatisticDto
    {
        $this->closed = $closed;

        return $this;
    }
}
