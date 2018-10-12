<?php

namespace App\Modules\Users\Http\Controllers\Admin;

use App\Modules\Users\DataTables\CustomerDataTable;
use App\Modules\Users\Http\Requests\Admin\ChangeCustomerStatusRequest;
use App\Modules\Users\Repositories\CustomerRepository;
use Flash;
use App\Http\Controllers\Controller;
use Response;

class CustomerController extends Controller
{
    /** @var  CustomerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param CustomerDataTable $customerDataTable
     * @return Response
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        return $customerDataTable->render('customers.index');
    }
    /**
     * Display the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(int $id)
    {
        $customer = $this->customerRepository->findWithoutFail($id);

        if (null === $customer) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show')->with('customer', $customer);
    }

    /**
     * @param ChangeCustomerStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeStatus(ChangeCustomerStatusRequest $request, int $id)
    {
        $customer = $this->customerRepository->findWithoutFail($id);
        $status = $request->get('status');

        if (null === $customer) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        $customer->status = $status;
        $this->customerRepository->save($customer);
        // TODO сделать удаление сессии

        Flash::success('Customer status changed successfully');

        return redirect(route('customers.show', $customer));
    }
}
