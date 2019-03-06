<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 19.02.2019
 */

namespace App\Modules\Users\Customer\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\DTO\RecentlyViewedSearchDto;
use App\Modules\Users\Customer\Http\Requests\Api\RecentlyViewedRequest;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Customer\Repositories\CustomerRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RecentlyViewedController
 * @package App\Modules\Users\Customer\Http\Controllers\Api
 */
class RecentlyViewedController extends Controller
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;
    /**
     * @var Customer
     */
    private $customer;

    /**
     * RecentlyViewedController constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
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

    /**
     * @param RecentlyViewedRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function get(RecentlyViewedRequest $request)
    {
        $recentlyViewedDto = app()[RecentlyViewedSearchDto::class];

        $recentlyViewedDto
            ->setOffset($request->get('offset', 0))
            ->setKeyword($request->keyword);

        return response()->json([
            'products' => $this->customerRepository->getRecentlyViewed($this->customer, $recentlyViewedDto),
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Product $product)
    {
        $this->customer->recentlyViewed()->detach($product);

        return response()->json(['success' => true]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        $this->customer->recentlyViewed()->detach();

        return response()->json(['success' => true]);
    }
}
