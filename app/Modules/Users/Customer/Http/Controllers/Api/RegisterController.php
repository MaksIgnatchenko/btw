<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Api\Requests\RegisterRequest;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /** @var Customer */
    protected $customer;

    /**
     * AuthController constructor.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard(): Guard
    {
        return Auth::guard('customer');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->customer->fill($request->all());
        $this->customer->save();

        $credentials = $request->only('email', 'password');
        $token = $this->guard()->attempt($credentials);

        return response()->json([
            'token' => $token,
            'customer' => $this->customer,
        ]);
    }


}
