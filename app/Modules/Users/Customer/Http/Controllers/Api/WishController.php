<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 11.10.2018
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\DTO\WishListSearchDto;
use App\Modules\Users\Customer\Http\Requests\Api\WishListRequest;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Customer\Repositories\CustomerRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    /** @var Customer */
    protected $customer;

    /** @var WishListRepository */
    protected $customerRepo;

    /**
     * WishController constructor.
     *
     * @param $customer
     */
    public function __construct()
    {
        $this->customer = Auth::user();
        $this->customerRepo = app()[CustomerRepository::class];
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard(): Guard
    {
        return Auth::guard('customer');
    }

    public function add(Product $product)
    {
        $this->customerRepo->addToWishList($this->customer, $product->id);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function remove(Product $product)
    {
        $this->customerRepo->removeFromWishList($this->customer, $product->id);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function get(WishListRequest $request)
    {
        $wishListSearchDto = app()[WishListSearchDto::class];

        $wishListSearchDto
            ->setOffset($request->get('offset', 0))
            ->setKeyword($request->keyword);

        return response()->json([
            'products' => $this->customerRepo->getWishList($this->customer, $wishListSearchDto),
        ]);
    }
}
