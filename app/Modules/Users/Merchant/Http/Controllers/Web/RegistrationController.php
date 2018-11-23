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
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /** @var MerchantRepository */
    protected $merchantModel;

    /** @var GeographyServiceInterface */
    protected $geographyService;

    /** @var CategoryRepository */
    protected $categoryRepository;

    /**
     * RegistrationController constructor.
     *
     * @param Merchant                  $merchantModel
     * @param CategoryRepository        $categoryRepository
     * @param GeographyServiceInterface $geographyService
     */
    public function __construct(
        Merchant $merchantModel,
        CategoryRepository $categoryRepository,
        GeographyServiceInterface $geographyService
    )
    {
        $this->merchantModel = $merchantModel;
        $this->geographyService = $geographyService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signUp(Request $request)
    {
        if ($request->session()->has('first_name')) {
            $countries = $this->geographyService
                ->getCountries()
                ->pluck('name', 'id');

            $categories = $this->categoryRepository
                ->findRootCategories()
                ->pluck('name', 'id');

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

        $builder = new CaptchaBuilder();
        $builder->build();

        $request->session()->put('captcha', $builder->getPhrase());

        return view('merchants.web.register', [
            'captcha' => $builder->inline(),
        ]);
    }

    /**
     * @param RegisterMerchantRequest $request
     *
     * @return RedirectResponse
     */
    public function setAccountInfo(RegisterMerchantRequest $request)
    {
        $request->session()->put($request->all());

        return redirect()->route('merchant.registration.sign-up');
    }

    /**
     * @param RegisterMerchantContactDataRequest $request
     *
     * @return RedirectResponse
     */
    public function setContactInfo(RegisterMerchantContactDataRequest $request)
    {
        $request->session()->put($request->all());

        return redirect()->route('merchant.registration.sign-up');
    }

    /**
     * @param RegisterMerchantCompanyRequest $request
     *
     * @return RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function setStoreInfo(RegisterMerchantCompanyRequest $request)
    {
        $merchant = $this->merchantModel
            ->createWithRelations(array_merge($request->session()->all(), $request->all()));

        $request->session()->flush();

        Auth::guard('merchant')->login($merchant);

        return redirect()->route('products.index');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function restoreContactData(Request $request)
    {
        $request->session()->put($request->all());

        $countries = $this->geographyService->getCountries()->pluck('name', 'id');

        return view('merchants.web.country-info', [
            'countries' => $countries,
        ]);
    }

}