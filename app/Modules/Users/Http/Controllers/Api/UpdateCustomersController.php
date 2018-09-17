<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\CustomerAddressRepository;
use App\Modules\Users\Repositories\CustomerDeliveryAddressRepository;
use App\Modules\Users\Requests\Api\Address\UpdateCustomerAddressRequest;
use App\Modules\Users\Requests\Api\Address\UpdateCustomerDeliveryAddressRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateCustomersController
{
    /**
     * @param UpdateCustomerAddressRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function address(UpdateCustomerAddressRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Customer $customer */
        $customer = $user->customer;

        /** @var CustomerAddressRepository $customerAddressRepository */
        $customerAddressRepository = app()[CustomerAddressRepository::class];

        $customerAddress = $customerAddressRepository->firstOrNew(['customer_id' => $customer->id]);
        $customerAddress->fill($request->all());
        $customerAddressRepository->save($customerAddress);

        return response()->json(['success' => true]);
    }

    /**
     * @param UpdateCustomerDeliveryAddressRequest $request
     *
     * @return JsonResponse
     */
    public function deliveryAddress(UpdateCustomerDeliveryAddressRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Customer $customer */
        $customer = $user->customer;

        /** @var CustomerDeliveryAddressRepository $customerDeliveryAddressRepository */
        $customerDeliveryAddressRepository = app()[CustomerDeliveryAddressRepository::class];

        $customerDeliveryAddress = $customerDeliveryAddressRepository->firstOrNew(['customer_id' => $customer->id]);
        $customerDeliveryAddress->fill($request->all());
        $customerDeliveryAddressRepository->save($customerDeliveryAddress);

        return response()->json(['success' => true]);
    }
}
