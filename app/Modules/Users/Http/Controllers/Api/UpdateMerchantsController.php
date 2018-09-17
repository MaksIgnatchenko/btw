<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Modules\Users\Events\MerchantAddressChangedEvent;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\MerchantRepository;
use App\Modules\Users\Requests\Api\Address\UpdateMerchantAddressRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateMerchantsController
{
    /**
     * @param UpdateMerchantAddressRequest $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function address(UpdateMerchantAddressRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Merchant $merchant */
        $merchant = $user->merchant;
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app()[MerchantRepository::class];

        $merchant->fill($request->only(['longitude', 'latitude', 'address']));
        $merchantRepository->save($merchant);

        $event = new MerchantAddressChangedEvent();
        $event->setMerchant($merchant);

        event($event);

        return response()->json(['success' => true]);
    }
}
