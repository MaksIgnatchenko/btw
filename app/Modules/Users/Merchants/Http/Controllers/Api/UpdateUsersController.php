<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.12.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Events\ChangePaymentOptionEvent;
use App\Modules\Users\Models\Device;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\DeviceRepository;
use App\Modules\Users\Repositories\MerchantRepository;
use App\Modules\Users\Requests\Api\SetPushTokenRequest;
use App\Modules\Users\Requests\Api\UpdatePayoutOptionsRequestInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateUsersController extends Controller
{
    /**
     * @param SetPushTokenRequest $request
     *
     * @return JsonResponse
     */
    public function pushToken(SetPushTokenRequest $request): JsonResponse
    {
        /** @var User $user */
        $userId = Auth::id();
        /** @var DeviceRepository $deviceRepository */
        $deviceRepository = app()[DeviceRepository::class];
        /** @var Device $device */
        $device = $deviceRepository->firstOrNew(['user_id' => $userId]);
        $device->push_token = $request->get('push_token');
        $device->device_type = $request->get('device_type');

        $deviceRepository->save($device);

        return response()->json(['success' => true]);
    }

    /**
     * @param UpdatePayoutOptionsRequestInterface $request
     *
     * @return JsonResponse
     */
    public function paymentOption(UpdatePayoutOptionsRequestInterface $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Merchant $merchant */
        $merchant = $user->merchant;

        $merchantAddedEvent = new ChangePaymentOptionEvent($merchant, $request);
        event($merchantAddedEvent);

        $merchant->payment_option = $request->get('payment_option');
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app()[MerchantRepository::class];
        $merchantRepository->save($merchant);

        return response()->json(['success' => true]);
    }
}
