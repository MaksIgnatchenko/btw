<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.01.2018
 */


namespace App\Modules\Orders\Dto;

class OutcomeStatisticDto
{
    /** @var int $count */
    protected $count;
    /** @var float $paymentsCount */
    protected $amount;

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $paymentsCount
     *
     * @return OutcomeStatisticDto
     */
    public function setCount(int $paymentsCount): OutcomeStatisticDto
    {
        $this->count = $paymentsCount;

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
     * @return OutcomeStatisticDto
     */
    public function setAmount(float $amount): OutcomeStatisticDto
    {
        $this->amount = $amount;

        return $this;
    }
}
