<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.01.2018
 */

namespace App\Modules\Order\Enums;

class OrderMerchantFilterEnum
{
    public const PENDING_REDEMPTION = 'pending-redemption';
    public const PENDING_PAYOUT = 'pending-payout';
    public const COMPLETED_TRANSACTIONS = 'completed-transactions';
    public const RETURNED = 'returned';

    /**
     * @return string
     */
    public static function toString(): string
    {
        return self::PENDING_REDEMPTION
            . ','
            . self::PENDING_PAYOUT
            . ','
            . self::COMPLETED_TRANSACTIONS
            . ','
            . self::RETURNED;
    }


    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::PENDING_REDEMPTION,
            self::PENDING_PAYOUT,
            self::COMPLETED_TRANSACTIONS,
            self::RETURNED,
        ];
    }

    /**
     * @param string $status
     *
     * @return bool
     */
    public function check(string $status): bool
    {
        if (!\in_array($status, self::toArray(), true)) {
            return false;
        }

        return true;
    }
}
