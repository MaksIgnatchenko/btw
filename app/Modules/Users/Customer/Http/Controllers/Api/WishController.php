<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 11.10.2018
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\Http\Requests\Api\WishListRequest;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    /** @var Customer */
    protected $customer;

    /**
     * WishController constructor.
     *
     * @param $customer
     */
    public function __construct()
    {
        $this->customer = Auth::user();
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
        $this->customer->wishes()->syncWithoutDetaching($product->id);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function remove(Product $product)
    {
        $this->customer->wishes()->attach($product->id);
    }

    public function get(WishListRequest $request)
    {
        return response()->json([
            'products' => $this->customer->wishes()
                ->with('wishlist')
                ->offset($request->get('offset', 0))
                ->take(Product::PRODUCTS_PAGE_LIMIT)
                ->get(),
        ]);
    }
}
