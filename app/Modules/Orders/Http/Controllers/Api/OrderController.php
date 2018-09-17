<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.01.2018
 */

namespace App\Modules\Orders\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Exceptions\WrongReturnDetailsException;
use App\Modules\Orders\Factories\FiltersFactory;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Orders\Requests\GetOrdersRequest;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
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
        $role = $user->roles()->get()[0];
        $userTypeId = $user->getUserTypeId();

        $filterFactory = FiltersFactory::get($role->name);
        $filter = $filterFactory->get($filter);

        $orders = $filter->getOrders($userTypeId, $offset);

        return response()->json([
            'orders' => $orders,
        ]);
    }

    /**
     * @param string $qrCode
     *
     * @return JsonResponse
     */
    public function show(string $qrCode): JsonResponse
    {
        $user = Auth::user();
        $merchantId = $user->merchant->id;
        $order = $this->getOrder($qrCode, $merchantId);

        return response()->json(['order' => $order]);
    }

    /**
     * @param string $qrCode
     *
     * @return JsonResponse
     * @throws \App\Modules\Orders\Exceptions\WrongOrderStatusException
     */
    public function update(string $qrCode): JsonResponse
    {
        $user = Auth::user();
        $merchantId = $user->merchant->id;
        $order = $this->getOrder($qrCode, $merchantId);

        try {
            $order->updateStatus();
        } catch (WrongReturnDetailsException $e) {
            report($e);

            return response()->json([
                'message' => $e->getMessage(),
                'errors'  => [
                    'qr_code' => [$e->getMessage()],
                ],
            ], 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param string $qrCode
     * @param int $merchantId
     *
     * @return \App\Modules\Orders\Models\Order|JsonResponse
     */
    protected function getOrder(string $qrCode, int $merchantId)
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        $order = $orderRepository->findByQrCode($qrCode, $merchantId);

        if (null === $order) {
            abort(400, 'There is no such order');
        }
        $order->setHidden(['customer_id']);

        return $order;
    }
}
