<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-21
 * Time: 13:23
 */

namespace App\Modules\Orders\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
        $trackingNumber = $request->input('msg.tracking_number');
        $status = $request->input('msg.tag');



    }
}