<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Notifications\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Notifications\Requests\StorePushSettingsRequest;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PushSettingsAPIController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $userType = $user->getCurrentUserTypeModel();
        $settings = $userType->getPushSettings();

        return response()->json(['settings' => $settings]);
    }

    /**
     * @return JsonResponse
     */
    public function store(StorePushSettingsRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $userType = $user->getCurrentUserTypeModel();
        $userType->updatePushSettings($request->all());

        return response()->json(['success' => true]);
    }
}
