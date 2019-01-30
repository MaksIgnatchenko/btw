<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-14
 * Time: 15:53
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Requests\Api\UpdateDeliveryInformationRequest;
use App\Modules\Users\Customer\Models\CustomerDeliveryInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DeliveryInformationController extends Controller
{
    /**
     * @param UpdateDeliveryInformationRequest $request
     * @return JsonResponse
     */
    public function store(UpdateDeliveryInformationRequest $request)
    {
        $attributes = [
            'customer_id' => Auth::id(),
        ];
        $address = CustomerDeliveryInformation::firstOrNew($attributes);
        $address->fill($request->all());
        $address->customer_id = Auth::id();
        $address->save();

        return $address;
    }
}