<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.11.2018
 */

namespace App\Modules\Orders\Helpers;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderViewHelper
{
    /**
     * example: id:58 -> id:000000058
     *          id:2  -> id:000000002
     *
     * @param int $id
     * @return string
     */
    public static function formatOrderId(int $id): string
    {
        return str_pad($id, 9, '0', STR_PAD_LEFT);
    }

    /**
     * @param string $date
     * @return string
     */
    public static function formatDate(string $date): string
    {
        return date(config('wish.orders.date_format'), strtotime($date));
    }

    /**
     * @param LengthAwarePaginator $orders
     * @param null|string $searchText
     * @return bool
     */
    public static function showSearch(LengthAwarePaginator $orders, ?string $searchText = null): bool
    {
        return (!$orders->isEmpty() || null !== $searchText);
    }
}
