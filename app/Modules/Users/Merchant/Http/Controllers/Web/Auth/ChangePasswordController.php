<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Users\Http\Controllers\ChangePasswordInterface;
use App\Modules\Users\Http\Traits\ChangePassword;
use App\Modules\Users\Merchant\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller implements ChangePasswordInterface
{
    use ChangePassword {
        change as changeUserPassword;
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
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function onWrongPassword()
    {
        return back()->withErrors(['old_password' => ['Wrong old password. Please try again']]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function returnSuccessResult()
    {
        return back();
    }
}
