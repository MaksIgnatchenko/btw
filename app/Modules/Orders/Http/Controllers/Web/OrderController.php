<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.11.2018
 */

namespace App\Modules\Orders\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Helpers\OrderViewHelper;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Orders\Requests\Web\UpdateOrderRequest;
use App\Modules\Orders\Shipping\ShippingException;
use App\Modules\Orders\Shipping\ShippingServiceInterface;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /** @var OrderRepository */
    protected $orderRepository;

    /** @var ShippingServiceInterface */
    protected $shippingService;

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
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->middleware('owns:order', ['only' => ['show', 'update']]);
        $this->shippingService = app(ShippingServiceInterface::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $merchantId = Auth::id();
        $orders = $this->orderRepository->getAllMerchantOrdersWithPagination($merchantId);
        $showSearch = OrderViewHelper::showSearch($orders);

        return view('orders.web.index', [
            'orders' => $orders,
            'orderStatuses' => OrderStatusEnum::toArray(),
            'showSearch' => $showSearch,
        ]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('orders.web.show', ['order' => $order, 'orderStatuses' => OrderStatusEnum::toArray()]);
    }

    /**
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $trackingNumber = $request->get('tracking_number');
        try {
            $shipping = $this->shippingService->set($trackingNumber);
        } catch (ShippingException $e) {

            return redirect(route('web.orders.show', $order->id))
                ->withErrors(['tracking_number' => 'Current tracking number is already exists'])
                ->withInput();
        }

        $this->orderRepository->changeOrderStatusToShipped($order, $shipping);

        return redirect(route('web.orders.show', $order->id));
    }
}
