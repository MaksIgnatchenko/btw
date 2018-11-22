<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 21.11.2018
 */

namespace App\Modules\Users\Http\Traits;

use App\Modules\Users\Http\Requests\ChangePasswordRequestAbstract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait ChangePassword
{
    /**
     * @param ChangePasswordRequestAbstract $request
     *
     * @return mixed
     */
    public function change(ChangePasswordRequestAbstract $request)
    {
        /** @var Authenticatable $user */
        $user = Auth::user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            return $this->onWrongPassword();
        }

        $user->password = $request->get('new_password');
        $user->save();

        return $this->returnSuccessResult();
    }
}