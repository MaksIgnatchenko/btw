<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.11.2018
 */

namespace App\Modules\Orders\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Helpers\OrderViewHelper;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Requests\SearchOrderRequest;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * @var Order
     */
    protected $orderModel;

    /**
     * SearchController constructor.
     * @param Order $orderModel
     * @param OrderStatusEnum $orderStatusEnum
     */
    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    /**
     * @param SearchOrderRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SearchOrderRequest $request)
    {
        $searchText = $request->get('search');
        $merchantId = Auth::id();

        $orders = $this->orderModel->search($merchantId, $searchText);
        $showSearch = OrderViewHelper::showSearch($orders, $searchText);

        return view('orders.web.index', [
            'orders' => $orders,
            'orderStatuses' => OrderStatusEnum::toArray(),
            'searchText' => $searchText,
            'showSearch' => $showSearch,
        ]);
    }
}
