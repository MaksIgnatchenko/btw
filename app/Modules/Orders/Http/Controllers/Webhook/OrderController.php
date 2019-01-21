<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-21
 * Time: 13:23
 */

namespace App\Modules\Orders\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Shipping\AfterShippingHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @throws \App\Modules\Orders\Shipping\ShippingException
     */
    public function update(Request $request)
    {
        $trackingNumber = $request->input('msg.tracking_number');
        $status = $request->input('msg.tag');

        Log::info("Aftershipping webhook. Tracking number - {$trackingNumber}, tracking number - {$status}");

        $orderStatus = AfterShippingHelper::getOrderStatus($status);

        Order::where('tracking_number', $trackingNumber)
            ->update(['status' => $orderStatus]);
    }
}