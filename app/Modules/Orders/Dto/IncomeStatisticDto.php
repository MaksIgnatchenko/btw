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
    protected $inProcess;
    /** @var int */
    protected $shipped;
    /** @var int */
    protected $delivered;
    /** @var int */
    protected $pickedUp;
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
    public function getInProcess(): int
    {
        return $this->inProcess;
    }

    /**
     * @param int $inProcess
     *
     * @return IncomeStatisticDto
     */
    public function setInProcess(int $inProcess): IncomeStatisticDto
    {
        $this->inProcess = $inProcess;

        return $this;
    }

    /**
     * @return int
     */
    public function getShipped(): int
    {
        return $this->shipped;
    }

    /**
     * @param int $shipped
     *
     * @return IncomeStatisticDto
     */
    public function setShipped(int $shipped): IncomeStatisticDto
    {
        $this->shipped = $shipped;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelivered(): int
    {
        return $this->delivered;
    }

    /**
     * @param int $delivered
     * @return IncomeStatisticDto
     */
    public function setDelivered(int $delivered): IncomeStatisticDto
    {
        $this->delivered = $delivered;
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
    public function getClosed(): int
    {
        return $this->closed;
    }

    /**
     * @param int $closed
     * @return IncomeStatisticDto
     */
    public function setClosed(int $closed): IncomeStatisticDto
    {
        $this->closed = $closed;
        return $this;
    }
}
