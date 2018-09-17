<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 18.01.2018
 */

namespace App\Modules\Products\Helpers;

use App\Modules\Orders\Models\Order;
use App\Modules\Products\Models\Product;

class CalculatorHelper
{
    /**
     * @param Order $order
     *
     * @return float
     */
    public static function orderAmount(Order $order): float
    {
        /** @var Product $product */
        $product = app(Product::class);
        $product->forceFill((array)$order->product);
        $quantity = $order->quantity;
        $offerPrice = $product->offer_price;

        $amountWithoutTax = $quantity * $offerPrice;
        $taxAmount = ($product->tax / 100) * $offerPrice * $quantity;

        return (float)number_format($amountWithoutTax + $taxAmount, 2);
    }
}
