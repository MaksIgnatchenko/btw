<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-17
 * Time: 16:50
 */

namespace App\Modules\Orders\Shipping;

class Shipping
{
    /** @var string */
    protected $status;

    /** @var string */
    protected $trackingNumber;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Shipping
     */
    public function setStatus(string $status): Shipping
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return Shipping
     */
    public function setTrackingNumber(string $trackingNumber): Shipping
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }
}
