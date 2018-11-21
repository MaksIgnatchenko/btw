<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 10.11.2017
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Requests\Api\ChangePasswordRequest;
use App\Modules\Users\Http\Controllers\ChangePasswordInterface;
use App\Modules\Users\Http\Traits\ChangePassword;
use Illuminate\Http\JsonResponse;

class ChangePasswordController extends Controller implements ChangePasswordInterface
{
    use ChangePassword {
        change as changeUserPassword;
    }

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
     * @return mixed
     */
    public function change(ChangePasswordRequest $request)
    {
        return $this->changeUserPassword($request);
    }

    /**
     * @return JsonResponse|mixed
     */
    public function onWrongPassword()
    {
        return response()->json(['message' => 'Wrong old password. Please try again'], 400);
    }

    /**
     * @return JsonResponse|mixed
     */
    public function returnSuccessResult()
    {
        return response()->json(['message' => 'Password changed successfully']);
    }
}
