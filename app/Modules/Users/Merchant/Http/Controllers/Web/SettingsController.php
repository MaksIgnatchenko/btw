<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 8.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /** @var GeographyServiceInterface */
    protected $geographyService;

    /**
     * SettingsController constructor.
     *
     * @param GeographyServiceInterface $geographyService
     */
    public function __construct(GeographyServiceInterface $geographyService)
    {
        $this->geographyService = $geographyService;
    }


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



        return view('merchants.web.settings', [
            'merchant' => $merchant,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities ?? [],
            'merchantCountry' => $merchantCountry,
            'merchantStateId' => $merchantStateId,
            'merchantCityId' => $merchantCityId ?? null,
        ]);
    }
}
