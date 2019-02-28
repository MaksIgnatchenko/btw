<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

namespace App\Modules\Users\Customer\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Users\Customer\DataTables\CustomerDataTable;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Customer\Repositories\CustomerRepository;
use Flash;
use Illuminate\Http\Request;
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
        return $customerDataTable->render('customers.admin.index');
    }

    /**
     * Display the specified Customer.
     *
     * @param Customer $customer
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show(Customer $customer)
    {
        return view('customers.admin.show')->with('customer', $customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $this->customerRepository->update($request->all(), $customer->id);
        Flash::success('Customer updated successfully');

        return response()->json(['success' => true]);
    }
}
