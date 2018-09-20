<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 10.11.2017
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Requests\Api\ChangePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * @param ChangePasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function change(ChangePasswordRequest $request): JsonResponse
    {
        $user = Auth::user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            return response()->json(['message' => 'Wrong old password. Please try again'], 400);
        }

        $user->password = $request->get('new_password');
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }
}
