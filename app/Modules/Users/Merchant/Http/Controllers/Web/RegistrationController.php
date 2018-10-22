<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Requests\RegisterMerchantCompanyRequest;
use App\Modules\Users\Merchant\Requests\RegisterMerchantContactDataRequest;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
use App\Modules\Users\Requests\RegisterMerchantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /** @var MerchantRepository */
    protected $merchantRepository;

    /** @var GeographyServiceInterface */
    protected $geographyService;

    /** @var CategoryRepository */
    protected $categoryRepository;

    /**
     * RegistrationController constructor.
     *
     * @param MerchantRepository        $merchantRepository
     * @param CategoryRepository        $categoryRepository
     * @param GeographyServiceInterface $geographyService
     */
    public function __construct(
        MerchantRepository $merchantRepository,
        CategoryRepository $categoryRepository,
        GeographyServiceInterface $geographyService
    )
    {
        $this->merchantRepository = $merchantRepository;
        $this->geographyService = $geographyService;
        $this->categoryRepository = $categoryRepository;
    }

    public function signUp(Request $request)
    {
        if ($request->session()->has('first_name')) {
            $countries = $this->geographyService->getCountries()->pluck('name', 'id');
            $categories = $this->categoryRepository->all()->pluck('name', 'id');
            return view('merchants.web.tell-form', [
                'countries' => $countries,
                'categories' => $categories,
            ]);
        }

        if ($request->session()->has('email')) {
            $countries = $this->geographyService->getCountries()->pluck('name', 'id');

            return view('merchants.web.country-info', [
                'countries' => $countries,
            ]);
        }

        return view('merchants.web.register');
    }

    /**
     * @param RegisterMerchantRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setAccountInfo(RegisterMerchantRequest $request)
    {
        $request->session()->put($request->all());

        return redirect()->route('merchant.registration.sign-up');
    }

    /**
     * @param RegisterMerchantContactDataRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setContactInfo(RegisterMerchantContactDataRequest $request)
    {
        $request->session()->put($request->all());

        return redirect()->route('merchant.registration.sign-up');
    }

    public function setStoreInfo(RegisterMerchantCompanyRequest $request)
    {
        $merchant = Merchant::createWithRelations($request->session()->all() + $request->all());

        Auth::login($merchant);

        return view('');
    }

}