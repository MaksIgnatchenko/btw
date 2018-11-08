<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Orders\Repositories;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use Carbon\Carbon;
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
    public function getRedeemed(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::PICKED_UP,
        ])
            ->with('merchant.rating')
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getUnredeemed(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::PENDING,
        ])
            ->with('merchant.rating')
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
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
            ->with('merchant.rating')
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getRefunded(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::REFUNDED,
        ])
            ->with('merchant.rating')
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param int $customerId
     * @param int $offset
     *
     * @return Collection
     */
    public function getReturned(int $customerId, int $offset): Collection
    {
        return Order::where([
            'customer_id' => $customerId,
            'status'      => OrderStatusEnum::RETURNED,
        ])
            ->with('merchant.rating')
            ->offset($offset)
            ->limit(Order::PAGE_LIMIT)
            ->orderBy('created_at', 'DESC')
            ->get();
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
            ->where('status', OrderStatusEnum::PENDING)
            ->whereNull('outcome_id')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take(Order::PAGE_LIMIT)
            ->get();
    }

    /**
     * @param string $qrCode
     * @param $merchantId
     *
     * @return Order|null
     */
    public function findByQrCode(string $qrCode, $merchantId): ?Order
    {
        return Order::where([
            'merchant_id' => $merchantId,
            'qr_code'     => $qrCode,
        ])
            ->whereIn('status', [
                OrderStatusEnum::PENDING,
                OrderStatusEnum::PICKED_UP,
            ])
            ->forCustomer()
            ->first();
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
