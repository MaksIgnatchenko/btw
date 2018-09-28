<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Api\Requests\LoginRequest;
use App\Modules\Users\Customer\Http\Requests\Api\LoginSocialRequest;
use App\Modules\Users\Customer\Models\Customer;
use Facebook\FacebookApp;
use Facebook\FacebookClient;
use Facebook\FacebookRequest;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    /**
     * @var string
     */
    protected $facebookFields = 'id,first_name,last_name,name,gender,email,birthday,location';

    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:customer', ['except' => [
            'login', 'redirectToProvider', 'handleProviderCallback', 'socialLogin',
        ]]);
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
            'expires_in' => $this->guard('customer')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * @param string $service
     *
     * @return mixed
     */
    public function redirectToProvider(string $service)
    {
        return Socialite::driver($service)
            ->stateless()
            ->redirect();
    }

    public function socialLogin(LoginSocialRequest $request, $service)
    {
        switch ($service) {
            case 'facebook':
                $response = $this->facebookLogin($request->get('token'));
                break;
            case 'google':
                $response = $this->googleLogin($request->get('token'));
                break;
        }

        return $response;
    }

    public function facebookLogin($serviceToken)
    {
        $appId = env('FACEBOOK_CLIENT_ID');
        $appSecret = env('FACEBOOK_CLIENT_SECRET');

        $app = new FacebookApp($appId, $appSecret);
        $fbRequest = new FacebookRequest($app, $serviceToken, 'GET', '/me?fields=' . $this->facebookFields);
        $client = new FacebookClient();

        $response = $client->sendRequest($fbRequest);

        $result = $response->getDecodedBody();

        $token = $this->authSocialUser($result);

        if (!$token) {
            return response()->json(['message' => 'Couldn\'t log in'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function googleLogin($serviceToken)
    {
        $client = new Client(['headers' => [
            'Authorization' => 'Bearer ' . $serviceToken,
        ]]);

        $res = $client->get('https://www.googleapis.com/oauth2/v1/userinfo');
        $result = json_decode($res->getBody()->getContents(), true);

        $token = $this->authSocialUser($result);

        if (!$token) {
            return response()->json(['message' => 'Couldn\'t log in'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function authSocialUser($socialUserData)
    {
        [$firstName, $lastName] = explode(' ', $socialUserData['name']);

        $user = Customer::firstOrCreate([
            'email' => $socialUserData['email'],
        ], [
            'email' => $socialUserData['email'],
            'first_name' => $firstName,
            'last_name' => $lastName,
            'password' => Hash::make(str_random(30)),
        ]);

        return Auth::login($user);
    }

    /**
     * @param string $service
     *
     * @return JsonResponse
     */
    public function handleProviderCallback(string $service)
    {
        $socialUser = Socialite::driver($service)->stateless()->user();
        list($firstName, $lastName) = explode(' ', $socialUser->name);

        $user = Customer::firstOrCreate([
            'email' => $socialUser->email,
        ], [
            'email' => $socialUser->email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'password' => Hash::make(str_random(30)),
        ]);

        $token = Auth::login($user);

        if (!$token) {
            return response()->json(['message' => 'Couldn\'t log in'], 401);
        }

        return $this->respondWithToken($token);
    }
}
