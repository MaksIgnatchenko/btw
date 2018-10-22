<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\Helpers\GeographyHelper;
use App\Modules\Users\Merchant\Requests\GeographyDataRequest;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Http\Request;

class GeographyController extends Controller
{
    protected $geographyService;

    /**
     * GeographyController constructor.
     *
     * @param $geographyService
     */
    public function __construct(GeographyServiceInterface $geographyService)
    {
        $this->geographyService = $geographyService;
    }

    public function getObjects(GeographyDataRequest $request)
    {
        return GeographyHelper::getObjectsByParentId($request->parent_id, $request->data_type)
            ->pluck('name', 'id');
    }

    public function getCountryPhoneCode(Request $request)
    {
        return $this->geographyService->getCountryById($request->country_id)->phoneCode;
    }
}