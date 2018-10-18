<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 12.10.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Users\Merchant\DataTables\MerchantDataTable;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
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
        return $merchantDataTable->render('merchants.index');
    }

    /**
     * Display the specified Merchant.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show($id)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);

        if (null === $merchant) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        $merchant->load('address', 'store');

        return view('merchants.show')->with('merchant', $merchant);
    }
}
