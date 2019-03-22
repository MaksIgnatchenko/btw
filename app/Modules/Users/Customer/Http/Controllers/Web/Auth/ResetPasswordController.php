<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 10.11.2017
 */

namespace App\Modules\Users\Customer\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * @return string
     */
    public function redirectTo()
    {
        return route('customer.password.success');
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {

        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'max:50',
                new PasswordRule(),
            ],
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'password.regex' => 'Invalid format. Password should contain at least 8 symbols of combination of digits and characters and special characters'
        ];
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     *
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function success()
    {
        return view('auth.passwords.success');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('customer');
    }
}
