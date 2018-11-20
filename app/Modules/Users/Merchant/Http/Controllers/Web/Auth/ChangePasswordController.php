<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Requests\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * @param ChangePasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function change(ChangePasswordRequest $request): JsonResponse
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();

        if (!Hash::check($request->get('old_password'), $merchant->password)) {
            return response()->json(['message' => 'Wrong old password. Please try again'], 400);
        }

        $merchant->password = $request->get('new_password');
        $merchant->save();

        return response()->json(['message' => 'Password changed successfully']);
    }
}
