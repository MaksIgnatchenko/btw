<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.12.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Models\Device;
use App\Modules\Users\Repositories\DeviceRepository;
use App\Modules\Users\Requests\Api\SetPushTokenRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{

    /**
     * @param SetPushTokenRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPushToken(SetPushTokenRequest $request): JsonResponse
    {
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
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard(): Guard
    {
        return Auth::guard('api');
    }
}
