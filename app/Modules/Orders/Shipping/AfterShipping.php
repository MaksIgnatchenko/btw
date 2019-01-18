<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-17
 * Time: 17:22
 */

namespace App\Modules\Orders\Shipping;

use AfterShip\Trackings;

class AfterShipping implements ShippingServiceInterface
{
    protected const SLUG = 'china-ems';

    /** @var Trackings */
    protected $trackings;

    /**
     * AfterShipping constructor.
     * @throws \AfterShip\AfterShipException
     */
    public function __construct(string $key)
    {
        $this->trackings = new Trackings($key);
    }

    /**
     * @param string $trackingNumber
     * @return Shipping|null
     * @throws \AfterShip\AfterShipException
     */
    public function find(string $trackingNumber): ?Shipping
    {
        $response = $this->trackings->get(self::SLUG, $trackingNumber);
        /** @var $shipping Shipping */
        $shipping = app(Shipping::class);

        $status = $response['data']['tracking']['status'];
        return $shipping->setStatus($status)->setTrackingNumber($trackingNumber);
    }

    /**
     * @param string $trackingNumber
     * @return Shipping
     */
    public function set(string $trackingNumber): Shipping
    {
        // TODO: Implement set() method.
    }

    /**
     * @param string $trackingNumber
     */
    public function delete(string $trackingNumber): void
    {
        // TODO: Implement delete() method.
    }
}