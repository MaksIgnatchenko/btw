<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Users\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Users\Events\CustomerAddedEvent;
use App\Modules\Users\Events\MerchantAddedEvent;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\CustomerRepository;
use App\Modules\Users\Repositories\MerchantRepository;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Requests\RegisterCustomerRequest;
use App\Modules\Users\Requests\RegisterMerchantRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    use AuthResponseTrait;

    /** @var User */
    protected $userModel;
    /** @var UserRepository */
    protected $userRepository;
    /** @var Customer */
    protected $customerModel;
    /** @var CustomerRepository */
    protected $customerRepository;
    /** @var Merchant */
    protected $merchantModel;
    /** @var MerchantRepository */
    protected $merchantRepository;

    /**
     * AuthController constructor.
     *
     * @param User $userModel
     * @param UserRepository $userRepository
     * @param Customer $customerModel
     * @param CustomerRepository $customerRepository
     * @param Merchant $merchantModel
     * @param MerchantRepository $merchantRepository
     */
    public function __construct(
        User $userModel,
        UserRepository $userRepository,
        Customer $customerModel,
        CustomerRepository $customerRepository,
        Merchant $merchantModel,
        MerchantRepository $merchantRepository
    ) {
        $this->userModel = $userModel;
        $this->userRepository = $userRepository;
        $this->customerModel = $customerModel;
        $this->customerRepository = $customerRepository;
        $this->merchantModel = $merchantModel;
        $this->merchantRepository = $merchantRepository;
    }

    /**
     * @param RegisterCustomerRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function registerCustomerAction(RegisterCustomerRequest $request)
    {
        $this->userModel->fill($request->all());
        $this->userRepository->save($this->userModel);

        $customerData = $request->all() + ['user_id' => $this->userModel->id];
        $this->customerModel->fill($customerData);
        $this->customerRepository->save($this->customerModel);

        $customerAddedEvent = new CustomerAddedEvent($this->userModel, $this->customerModel);
        event($customerAddedEvent);

        $credentials = $request->only('username', 'password');
        $token = $this->guard()->attempt($credentials);

        return $this->respondWithTokenFull($token, $this->userModel);
    }

    /**
     * @param RegisterMerchantRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function registerMerchantAction(RegisterMerchantRequest $request)
    {
        $this->userModel->fill($request->all());
        $this->userRepository->save($this->userModel);

        $merchantData = $request->all() + ['user_id' => $this->userModel->id];
        $this->merchantModel->fill($merchantData);
        $this->merchantModel->setStatus();
        $this->merchantRepository->save($this->merchantModel);
        $this->merchantModel->categories()->sync($request->get('categories'));

        $merchantAddedEvent = new MerchantAddedEvent($this->userModel, $this->merchantModel, $request);
        event($merchantAddedEvent);

        $credentials = $request->only('username', 'password');
        $token = $this->guard()->attempt($credentials);

        return $this->respondWithTokenFull($token, $this->userModel);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard(): Guard
    {
        return Auth::guard('api');
    }
}
