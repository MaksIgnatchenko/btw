<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 8.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Models\Category;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
use App\Modules\Users\Merchant\Requests\UpdateAccountSettingsRequest;
use App\Modules\Users\Merchant\Requests\UpdateStoreSettingsRequest;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /** @var GeographyServiceInterface */
    protected $geographyService;

    /** @var MerchantRepository */
    protected $merchantRepository;

    /**
     * SettingsController constructor.
     *
     * @param GeographyServiceInterface $geographyService
     */
    public function __construct(GeographyServiceInterface $geographyService, MerchantRepository $merchantRepository)
    {
        $this->geographyService = $geographyService;
        $this->merchantRepository = $merchantRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $merchant = Auth::guard('merchant')->user();
        $countries = $this->geographyService->getCountries()->pluck('name', 'id');

        $merchantCountry = GeographyCountry::where('sortname', $merchant->address->country)->first();
        $merchant->phone = str_replace($merchantCountry->phoneCode, '', $merchant->phone);

        $states = $this->geographyService
            ->getStates($merchantCountry->id)->pluck('name', 'id');

        $merchantStateId = $this->geographyService
            ->getStateByName($merchant->address->state, $merchantCountry->id)->id;

        if(!empty($merchant->address->city)) {
            $merchantCityId = $this->geographyService
                ->getCityByName($merchant->address->city, $merchantStateId)->id;

            $cities = $this->geographyService
                ->getCities($merchantStateId)->pluck('name', 'id');
        }

        $storeCategories = $merchant->store->categories->pluck('id');
        $categories = Category::where('parent_category_id', null)->pluck('name', 'id');

        $merchantStoreCountry = GeographyCountry::where('sortname', $merchant->store->country)->first();


        return view('merchants.web.settings', [
            'merchant' => $merchant,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities ?? [],
            'categories' => $categories,
            'storeCategories' => $storeCategories,
            'merchantCountry' => $merchantCountry,
            'merchantStoreCountry' => $merchantStoreCountry,
            'merchantStateId' => $merchantStateId,
            'merchantCityId' => $merchantCityId ?? null,
        ]);
    }

    /**
     * @param UpdateAccountSettingsRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccountSettings(UpdateAccountSettingsRequest $request)
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();
        $merchant->updateAccountInfo($request->all());

        return back();
    }

    /**
     * @param UpdateStoreSettingsRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStoreSettings(UpdateStoreSettingsRequest $request)
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();

        $merchant->store->updateStoreInfo($request->all());

        return back();
    }
}
