<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 07.11.2017
 */

namespace App\Modules\Users\Enums;

class PaymentOptionsEnum
{
    public const PAYPAL = 'paypal';
    public const WIRE = 'wire';
    public const CHEQUE = 'cheque';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [self::PAYPAL, self::WIRE, self::CHEQUE];
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::PAYPAL => 'Paypal',
            self::WIRE   => 'Wire transfer',
            self::CHEQUE => 'Cheque',
        ];
    }
}
