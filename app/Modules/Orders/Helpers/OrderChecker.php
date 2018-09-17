<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 30.01.2018
 */

namespace App\Modules\Orders\Helpers;

use App\Modules\Orders\Exceptions\WrongReturnDetailsException;
use App\Modules\Orders\Models\Order;
use Carbon\Carbon;

class OrderChecker
{
    /**
     * @param Order $order
     *
     * @return bool
     */
    public static function disableStatus(Order $order): bool
    {
        if (null === $order->outcome_id) {
            return false;
        }

        return true;
    }

    /**
     * @param Order $order
     *
     * @return bool
     * @throws WrongReturnDetailsException
     */
    public static function checkReturnDetails(Order $order): bool
    {
        $now = new Carbon();
        $dateForReturn = self::getReturnDetailsDate($order);

        if ($now > $dateForReturn) {
            return false;
        }

        return true;
    }

    /**
     * @param Order $order
     *
     * @return Carbon
     * @throws WrongReturnDetailsException
     */
    protected static function getReturnDetailsDate(Order $order): Carbon
    {
        $redeemedAt = $order->redeemed_at;
        $returnDetails = $order->product->return_details;

        $dates = [
            'Final sale (No return)' => (new Carbon($redeemedAt))->setTimestamp(0),

            '5 days return'  => (new Carbon($redeemedAt))->addDays(5),
            '10 days return' => (new Carbon($redeemedAt))->addDays(10),
            '30 days return' => (new Carbon($redeemedAt))->addDays(30),
        ];

        if (!array_key_exists($returnDetails, $dates)) {
            throw new WrongReturnDetailsException("Wrong return details - {$returnDetails}");
        }

        return $dates[$returnDetails];
    }
}
