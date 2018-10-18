<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 18.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('merchant');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function index()
    {
        return view('web.index');
    }
}