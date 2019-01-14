<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-14
 * Time: 15:53
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Requests\Api\UpdateAddressRequest;
use App\Modules\Users\Customer\Models\CustomerAddress;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * @param UpdateAddressRequest $request
     * @return JsonResponse
     */
    public function store(UpdateAddressRequest $request)
    {
        $attributes = [
            'customer_id' => Auth::id(),
        ];
        $address = CustomerAddress::firstOrNew($attributes);
        $address->fill($request->all());
        $address->customer_id = Auth::id();
        $address->save();

        return $address;
    }
}