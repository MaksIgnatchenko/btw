<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 2.11.2018
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Requests\Api\UpdateProfileRequest;
use App\Modules\Users\Customer\Repositories\CustomerRepository;
use http\Env\Response;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /** @var Customer */
    protected $customerRepository;

    /**
     * AuthController constructor.
     *
     * @param Customer $customer
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $customer = Auth::user();

        $customer->fill($request->all())
            ->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $avatar = $request->file('avatar');
        $result = $avatar->store('avatars/');

        return response()->json([
            'status' => 'success',
            'message' => $result,
        ]);
    }
}
