<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.11.2018
 */

namespace App\Modules\Orders\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderStatusEnum
     */
    protected $orderStatusEnum;

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('auth:merchant');
    }

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     * @param OrderStatusEnum $orderStatusEnum
     */
    public function __construct(OrderRepository $orderRepository, OrderStatusEnum $orderStatusEnum)
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusEnum = $orderStatusEnum::toArray();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $merchantId = Auth::user()->id;
        $orders = $this->orderRepository->getAllMerchantOrdersWithPagination($merchantId);

        return view('orders.web.index', ['orders' => $orders, 'orderStatusEnum' => $this->orderStatusEnum]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $merchantId = Auth::user()->id;
        $order = $this->orderRepository->getMerchantOrderById($id, $merchantId);

        return view('orders.web.show', ['order' => $order, 'orderStatusEnum' => $this->orderStatusEnum]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(int $id)
    {
        $merchantId = Auth::user()->id;
        $this->orderRepository->changeMerchantOrderStatusToShippedById($id, $merchantId);

        return redirect(route('web.orders.show', $id));
    }
}
