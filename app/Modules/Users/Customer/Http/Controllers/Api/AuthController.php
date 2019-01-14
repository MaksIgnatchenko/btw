<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\DTO\SocialServiceDto;
use App\Modules\Users\Customer\Events\CustomerCreatedFromFacebookEvent;
use App\Modules\Users\Customer\Factories\SocialServiceFactory;
use App\Modules\Users\Customer\Helpers\SocialAuthHelper;
use App\Modules\Users\Customer\Http\Api\Requests\LoginRequest;
use App\Modules\Users\Customer\Http\Requests\Api\LoginSocialRequest;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
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

            return $this->respondWithToken($token);
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
        $user->address;

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
        $socialServiceDto = new SocialServiceDto(
            $request->get('token'),
            $request->get('device')
        );

        $serviceInstance = SocialServiceFactory::getSocialServiceInstance($service, $socialServiceDto);

        $userData = $serviceInstance->getUserData();

        $token = $this->authSocialUser($userData);

        return $this->respondWithToken($token);
    }

    /**
     * @param $socialUserData
     */
    protected function authSocialUser($socialUserData)
    {
        $customer = Customer::where('email', $socialUserData['email'])->first();

        if (null === $customer) {
            if (SocialAuthHelper::isAvatarExists($socialUserData)) {
                $avatarImageName = SocialAuthHelper::createAvatarImageName('jpeg');
                $avatarImage = Image::make(file_get_contents(SocialAuthHelper::getAvatarUrl($socialUserData)))
                    ->encode();
            }

            $customer = Customer::create([
                'email' => $socialUserData['email'],
                'first_name' => $socialUserData['first_name'],
                'last_name' => $socialUserData['last_name'],
                'password' => Hash::make(str_random(30)),
                'avatar' => $avatarImageName ?? null,
            ]);

            $customerCreatedFromFacebookEvent = app(CustomerCreatedFromFacebookEvent::class);
            $customerCreatedFromFacebookEvent
                ->setCustomer($customer)
                ->setAvatarImageName($avatarImageName ?? null)
                ->setAvatarImage($avatarImage ?? null);
            event($customerCreatedFromFacebookEvent);
        }

        return Auth::login($customer);
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
