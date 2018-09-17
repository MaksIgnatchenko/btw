<?php

namespace App\Modules\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Users\DataTables\MerchantDataTable;
use App\Modules\Users\Http\Requests\Admin\ChangeMerchantStatusRequest;
use App\Modules\Users\Repositories\MerchantRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class MerchantController extends Controller
{

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /** @var  MerchantRepository */
    private $merchantRepository;

    public function __construct(MerchantRepository $merchantRepo)
    {
        $this->merchantRepository = $merchantRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param MerchantDataTable $merchantDataTable
     *
     * @return Response
     */
    public function index(MerchantDataTable $merchantDataTable)
    {
        return $merchantDataTable->render('merchants.index');
    }

    /**
     * Display the specified Merchant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(int $id)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);

        if (null === $merchant) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        return view('merchants.show')->with('merchant', $merchant);
    }

    /**
     * @param ChangeMerchantStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeStatus(ChangeMerchantStatusRequest $request, int $id)
    {
        $merchant = $this->merchantRepository->findWithoutFail($id);
        $status = $request->get('status');

        if (null === $merchant) {
            Flash::error('Merchant not found');

            return redirect(route('merchants.index'));
        }

        $merchant->status = $status;
        $this->merchantRepository->save($merchant);
        // TODO сделать удаление сессии

        Flash::success('Merchant status changed successfully');

        return redirect(route('merchants.show', $merchant));
    }
}
