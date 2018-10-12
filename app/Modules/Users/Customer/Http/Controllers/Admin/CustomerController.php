<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

namespace App\Modules\Users\Customer\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\DataTables\CustomerDataTable;
use App\Modules\Users\Customer\Repositories\CustomerRepository;
use Flash;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private $customerRepository;

    /**
     * CustomerController constructor.
     * @param $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param CustomerDataTable $customerDataTable
     * @return mixed
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        return $customerDataTable->render('customers.index');
    }

    /**
     * Display the specified Customer.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function show($id)
    {
        $customer = $this->customerRepository->findWithoutFail($id);

        if (null === $customer) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show')->with('customer', $customer);
    }
}