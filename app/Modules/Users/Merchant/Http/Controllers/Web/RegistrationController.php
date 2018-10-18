<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Requests\RegisterMerchantCompanyRequest;
use App\Modules\Users\Merchant\Requests\RegisterMerchantContactDataRequest;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
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

        return view('');
    }

    public function aboutStore(RegisterMerchantCompanyRequest $request)
    {
        $merchant = Merchant::create($request->session()->all());
        $merchant->address()->create($request->session()->all());
        $merchant->store()->create($request->all());

        Auth::login($merchant);

        return view('');
    }


}