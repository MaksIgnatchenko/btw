<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\DataTables\MerchantDataTable;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class MerchantController extends Controller
{
    private $merchantRepository;

    /**
     * MerchantController constructor.
     * @param $customerRepository
     */
    public function __construct(MerchantRepository $merchantRepository)
    {
        $this->merchantRepository = $merchantRepository;
    }

    /**
     * Display a listing of the Merchants.
     *
     * @param MerchantDataTable $merchantDataTable
     * @return mixed
     */
    public function index(MerchantDataTable $merchantDataTable)
    {
        return $merchantDataTable->render('merchants.admin.index');
    }

    /**
     * @param Merchant $merchant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Merchant $merchant)
    {
        $merchant->load('address', 'store', 'store.categories');

        return view('merchants.admin.show')->with('merchant', $merchant);
    }

    /**
     * @param Request $request
     * @param Merchant $merchant
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, Merchant $merchant)
    {
        $this->merchantRepository->update($request->all(), $merchant->id);
        Flash::success(__('admin.flash.merchant.update.success'));

        return response()->json(['success' => true]);
    }
}
