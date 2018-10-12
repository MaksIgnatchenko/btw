<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthResponseTrait;

    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = $this->guard()->user();

            return $this->respondWithTokenFull($token, $user);
        }

        return response()->json(['message' => 'No such username or password'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->guard()->user();
        $user->load([
            'merchant',
            'customer.address',
            'customer.deliveryAddress',
            'merchant.rating',
            'merchant.merchantsReviews'
        ]);
        // TODO make prettier once time
        $response = array_merge($user->toArray(), [
            'roles' => [
                'name' => $user->roles->first()->name
            ]
        ]);

        if ($user->merchant) {
            $response['payment_options'] = $user->merchant->getPaymentData();
        }

        return response()->json($response);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard(): Guard
    {
        return Auth::guard();
    }
}
