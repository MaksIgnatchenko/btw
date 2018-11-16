<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Factories\FilterOrderFactory;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Orders\Requests\GetOrdersRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('auth:customer');
    }

    /**
     * @param GetOrdersRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Orders\Exceptions\WrongFilterException
     */
    public function index(GetOrdersRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $filter = $request->get('filter');
        $offset = $request->get('offset', 0);

        $filter = FilterOrderFactory::get($filter);
        $orders = $filter->getOrders($user->id, $offset);

        return response()->json([
            'orders' => $orders,
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = Auth::user();
        $order = $this->getOrder($id, $user->id);

        return response()->json(['order' => $order]);
    }

    /**
     * @param int $orderId
     * @param int $customerId
     * @return \App\Modules\Orders\Models\Order|null
     */
    protected function getOrder(int $orderId, int $customerId)
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        $order = $orderRepository->findCustomerOrderById($orderId, $customerId);

        if (null === $order) {
            abort(400, 'There is no such order');
        }
        $order->setHidden(['customer_id']);

        return $order;
    }
}
