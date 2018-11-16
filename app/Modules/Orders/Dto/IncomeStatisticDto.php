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
}
