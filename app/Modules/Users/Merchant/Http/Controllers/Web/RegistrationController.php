<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Enums\MerchantRegistrationCountriesEnum;
use App\Modules\Users\Merchant\Providers\GeographyServiceProvider;
use App\Modules\Users\Merchant\Requests\RegisterMerchantCompanyRequest;
use App\Modules\Users\Merchant\Requests\RegisterMerchantContactDataRequest;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Repositories\MerchantRepository;
use App\Modules\Users\Requests\RegisterMerchantRequest;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    protected $merchantRepository;
    protected $geographyService;

    /**
     * RegistrationController constructor.
     *
     * @param MerchantRepository        $merchantRepository
     * @param GeographyServiceInterface $geographyService
     */
    public function __construct(MerchantRepository $merchantRepository, GeographyServiceInterface $geographyService)
    {
        $this->merchantRepository = $merchantRepository;
        $this->geographyService = $geographyService;
    }

    public function signUp(RegisterMerchantRequest $request)
    {
        $request->session()->put($request->all());

        $countries = $this->geographyService->getCountries();

        return view('', [
            'countries' => $countries
        ]);
    }

    public function contactInfo(RegisterMerchantContactDataRequest $request)
    {
        $request->session()->put($request->all());

        return response()->redirectToRoute('');
    }

    public function aboutStore(RegisterMerchantCompanyRequest $request)
    {
        if($request->isMethod('GET')) {
            return view('', []);
        }

        $merchant = Merchant::create($request->session()->all());
        $merchant->adress()->create($request->session()->all());
        $merchant->store()->create($request->all());

        Auth::login($merchant);

        return view('');
    }


}