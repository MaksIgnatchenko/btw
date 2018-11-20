<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.11.2018
 */

namespace App\Modules\Orders\Helpers;

use Illuminate\Http\Request;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;

class OrderViewHelper
{
    /**
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
     * @param Order $order
     * @return int
     */
    public static function getAmount(Order $order): int
    {
        return $order->quantity * $order->product->price;
    }

    /**
     * @return bool
     */
    public static function isSearchResults(): bool
    {
        $request = app()[Request::class];

        return null !== $request->get('search');
    }

    /**
     * @param Order $order
     * @return bool
     */
    public static function isShipped(Order $order): bool
    {
        return $order->status === OrderStatusEnum::SHIPPED;
    }
}
