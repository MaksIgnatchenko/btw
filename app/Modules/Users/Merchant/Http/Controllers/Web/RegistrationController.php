<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 16.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Enums\MerchantRegistrationCountriesEnum;
use App\Modules\Users\Merchant\Requests\RegisterMerchantCompanyRequest;
use App\Modules\Users\Merchant\Requests\RegisterMerchantContactDataRequest;
use App\Modules\Users\Models\Merchant;
use App\Modules\Users\Requests\RegisterMerchantRequest;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    protected $merchantRepository;

    /**
     * RegistrationController constructor.
     *
     * @param $merchntRepository
     */
    public function __construct($merchantRepository)
    {
        $this->merchantRepository = $merchantRepository;
    }

    public function signUp(RegisterMerchantRequest $request)
    {
        if($request->isMethod('GET')) {
            return view('', []);
        }

        $merchant = Merchant::create($request->all());
        Auth::login($merchant);

        return response()->redirectToRoute('');

    }

    public function contactInfo(RegisterMerchantContactDataRequest $request)
    {
        $countries = MerchantRegistrationCountriesEnum::COUNTRIES;

        if($request->isMethod('GET')) {
            return view('', compact($countries));
        }

        Auth::user()->address()->create($request->all());

        return response()->redirectToRoute('');
    }

    public function aboutStore(RegisterMerchantCompanyRequest $request)
    {
        if($request->isMethod('GET')) {
            return view('', []);
        }

        Auth::user()->update($request->all());

        return response()->redirectToRoute('');
    }


}