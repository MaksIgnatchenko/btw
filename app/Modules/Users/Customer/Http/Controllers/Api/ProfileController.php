<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 2.11.2018
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\Http\Requests\Api\UpdateProfileRequest;
use App\Modules\Users\Customer\Http\Requests\Api\UploadAvatarRequest;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Customer\Repositories\CustomerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function uploadAvatar(UploadAvatarRequest $request): JsonResponse
    {
        $avatar = $request->file('avatar');

        $result = $avatar->store(config('wish.storage.customers.avatar_path'));

        $customer = Auth::user();
        $customer->avatar = $avatar->hashName();
        $customer->save();

        return response()->json([
            'avatar' => Storage::url($result),
        ]);
    }
}
