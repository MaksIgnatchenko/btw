<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Orders\Repositories;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class OrderRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Order::class;
    }

    /**
     * @param Order $order
     */
    public function save(Order $order): void
    {
        $order->save();
    }

    /**
     * @param Order[] $orders
     */
    public function saveMany(array $orders): void
    {
        Order::insert($orders);
    }

    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getAll(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
        ])
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     * @return Collection
     */
    public function getShipped(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::SHIPPED,
        ])
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     * @return Collection
     */
    public function getInProcess(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::IN_PROCESS,
        ])
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     * @return Collection
     */
    public function getDelivered(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::DELIVERED,
        ])
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     * @return Collection
     */
    public function getPickedUp(int $customerId, int $offset): Collection
    {
        return Order::where('customer_id', $customerId)
            ->whereIn('status', [
                OrderStatusEnum::PICKED_UP,
                OrderStatusEnum::CLOSED,
            ])
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $merchantId
     * @return Builder
     */
    protected function getAllMerchantOrdersQueryBuilder(int $merchantId): Builder
    {
        return Order::where([
            'merchant_id' => $merchantId,
        ])->orderBy('created_at', 'DESC')->with(['customer', 'transaction']);
    }

    /**
     * @param int $merchantId
     * @return LengthAwarePaginator
     */
    public function getAllMerchantOrdersWithPagination(int $merchantId): LengthAwarePaginator
    {
        return $this->getAllMerchantOrdersQueryBuilder($merchantId)->paginate(config('wish.orders.pagination'));
    }

    /**
     * @param int $orderId
     * @param int $merchantId
     * @return mixed
     */
    public function getMerchantOrderById(int $orderId): ?Order
    {
        return Order::where('id', $orderId)->with('customer')->first();
    }

    /**
     * @param int $merchantId
     * @param int $offset
     *
     * @return Collection
     */
    public function findCompletedTransactions(int $merchantId, int $offset): Collection
    {
        return Order::where('merchant_id', $merchantId)
            ->forCustomer()
            ->withoutQrCode()
            ->where('status', OrderStatusEnum::PICKED_UP)
            ->whereNotNull('outcome_id')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take(Order::PAGE_LIMIT)
            ->get();
    }

    /**
     * @param Order $order
     */
    public function changeOrderStatusToShipped(Order $order):void
    {
        if ($order->status === OrderStatusEnum::IN_PROCESS) {
            $order->update([
                'status' => OrderStatusEnum::SHIPPED
            ]);
        }
    }

    /**
     * @param int $merchantId
     * @param string $searchText
     * @return LengthAwarePaginator
     */
    public function findMerchantOrdersBySearchTextWithPagination(int $merchantId, string $searchText): LengthAwarePaginator
    {
        return Order::with('customer')
        ->where('merchant_id', $merchantId)
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where(function ($query) use ($searchText) {
            $query->where('orders.id', 'LIKE', '%' . $searchText . '%');
            $query->orWhere('customers.first_name', 'LIKE', '%' . $searchText . '%');
            $query->orWhere('customers.last_name', 'LIKE', '%' . $searchText . '%');
        })
            ->select('orders.*', 'customers.first_name', 'last_name')
            ->paginate(config('wish.orders.pagination'));
    }

    /**
     * @param int $merchantId
     * @param int $offset
     *
     * @return Collection
     */
    public function findPendingPayout(int $merchantId, int $offset): Collection
    {
        return Order::where('merchant_id', $merchantId)
            ->forCustomer()
            ->withoutQrCode()
            ->where('status', OrderStatusEnum::PICKED_UP)
            ->whereNull('outcome_id')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take(Order::PAGE_LIMIT)
            ->get();
    }

    /**
     * @param int $merchantId
     * @param int $offset
     *
     * @return Collection
     */
    public function findPendingRedemption(int $merchantId, int $offset): Collection
    {
        return Order::where('merchant_id', $merchantId)
            ->forCustomer()
            ->withoutQrCode()
            ->where('status', OrderStatusEnum::IN_PROCESS)
            ->whereNull('outcome_id')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take(Order::PAGE_LIMIT)
            ->get();
    }

    public function findCustomerOrderById(int $orderId, int $customerId): ?Order
    {
        return Order::where([
            'customer_id' => $customerId,
            'id'          => $orderId,
        ])->first();
    }

    /**
     * @param int $merchantId
     *
     * @return Collection
     */
    public function findMerchantNotPaidOrders(int $merchantId): Collection
    {
        return Order::where('merchant_id', $merchantId)
            ->whereNull('outcome_id')
            ->orderBy('updated_at', 'desc')
            ->with('customer')
            ->get();
    }

    /**
     * @param int $merchantId
     * @param int $offset
     *
     * @return Collection
     */
    public function findMerchantReturnedOrders(int $merchantId, int $offset): Collection
    {
        return Order::where('merchant_id', $merchantId)
            ->forCustomer()
            ->withoutQrCode()
            ->whereIn('status', [OrderStatusEnum::REFUNDED, OrderStatusEnum::RETURNED])
            ->whereNull('outcome_id')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take(Order::PAGE_LIMIT)
            ->get();
    }

    /**
     * @param DateDto $dateDto
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getInRange(DateDto $dateDto): \Illuminate\Database\Eloquent\Collection
    {
        return Order::query()
            ->selectRaw('
                DATE_FORMAT(orders.created_at, "%e %b %Y") as "Purchase date", 
                product->"$.return_details"  as "Return policy", 
                product->"$.name"  as "Name", 
                orders.status as "Status",
                merchants.business_name as "Merchant",
                CONCAT(customers.first_name," ", customers.last_name) AS "Customer",
                outcome.net_amount as "Net amount"
            ')
            ->leftJoin('merchants', 'orders.merchant_id', '=', 'merchants.id')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftJoin('outcome', 'orders.outcome_id', '=', 'outcome.id')
            ->whereBetween('orders.created_at', [
                $dateDto->getDateFrom(),
                (new Carbon($dateDto->getDateTo()))->addDay(),
            ])
            ->get();
    }
}
