<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-17
 * Time: 17:22
 */

namespace App\Modules\Orders\Shipping;

use AfterShip\AfterShipException;
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

    // TODO maybe it doesn't needed
    /**
     * @param string $trackingNumber
     * @return Shipping|null
     * @throws ShippingException
     */
    public function find(string $trackingNumber): ?Shipping
    {
        try {
            $response = $this->trackings->get(self::SLUG, $trackingNumber);
        } catch (AfterShipException $e) {
            throw new ShippingException($e->getMessage());
        }
        /** @var $shipping Shipping */
        $shipping = app(Shipping::class);

        $status = $response['data']['tracking']['status'];
        return $shipping->setStatus($status)->setTrackingNumber($trackingNumber);
    }

    /**
     * @param string $trackingNumber
     * @return Shipping
     * @throws ShippingException
     */
    public function set(string $trackingNumber): Shipping
    {
        try {
            $response = $this->trackings->create($trackingNumber);
        } catch (AfterShipException $e) {
            throw new ShippingException($e->getMessage());
        }

        /** @var $shipping Shipping */
        $shipping = app(Shipping::class);

        dd($response);
        $status = $response['data']['tracking']['tag'];
        return $shipping->setStatus($status)->setTrackingNumber($trackingNumber);
    }

    /**
     * @param string $trackingNumber
     */
    public function delete(string $trackingNumber): void
    {
        // TODO: Implement delete() method.
    }
}