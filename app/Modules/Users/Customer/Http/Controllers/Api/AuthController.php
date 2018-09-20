<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:customer', ['except' => ['login']]);
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

    /**
     * Get a JWT token via given credentials.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = $this->guard()->user();

            return $this->respondWithToken($token, $user);
        }

        return response()->json(['message' => 'No such email or password'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->guard()->user();


        return response()->json($user);
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
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}
