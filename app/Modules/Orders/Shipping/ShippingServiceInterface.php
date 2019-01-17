<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-17
 * Time: 16:48
 */

namespace App\Modules\Orders\Shipping;

interface ShippingServiceInterface
{
    // TODO separate into several interfaces?
    /**
     * @param string $trackingNumber
     * @return Shipping|null
     */
    public function find(string $trackingNumber): ?Shipping;

    /**
     * @param string $trackingNumber
     * @return Shipping
     */
    public function set(string $trackingNumber): Shipping;

    /**
     * @param string $trackingNumber
     */
    public function delete(string $trackingNumber): void;
}