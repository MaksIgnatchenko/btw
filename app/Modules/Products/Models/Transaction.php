<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Models;

use App\Modules\Orders\Dto\IncomeStatisticDto;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Enums\TransactionStatusEnum;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Products\Repositories\TransactionRepository;
use App\Modules\Users\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class Transaction extends Model
{
    public $incrementing = false;

    public $fillable = [
        'customer_id',
        'cart',
        'message',
        'status',
        'amount',
    ];

    public $casts = [
        'customer_id' => 'integer',

        'cart'    => 'array',
        'message' => 'string',
        'status'  => 'string',
        'amount'  => 'float',
    ];

    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Uuid::uuid1();
        });
    }

    /**
     * @param int $customerId
     * @param float $amount
     *
     * @return Transaction
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function createTransaction(int $customerId, float $amount): Transaction
    {
        $transaction = new self();
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        /** @var TransactionRepository $transactionRepository */
        $transactionRepository = app(TransactionRepository::class);

        $carts = $cartRepository->findWhere(['customer_id' => $customerId]);
        $transaction->fill([
            'customer_id' => $customerId,

            'cart'   => $carts->toJson(),
            'status' => TransactionStatusEnum::PENDING,
            'amount' => $amount,
        ]);

        $transactionRepository->save($transaction);

        return $transaction;
    }

    /**
     * @return bool
     */
    public function checkPendingStatus(): bool
    {
        return $this->status === TransactionStatusEnum::PENDING;
    }


    /**
     * @return IncomeStatisticDto
     */
    public function getIncomePaymentStatistic(): IncomeStatisticDto
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        /** @var IncomeStatisticDto $incomePaymentStatisticDto */
        $incomePaymentStatisticDto = app(IncomeStatisticDto::class);
        /** @var TransactionRepository $transactionRepository */
        $transactionRepository = app(TransactionRepository::class);
        $transactions = $transactionRepository->findActive();
        $orders = $orderRepository->all();

        $refunded = $orders->filter(function ($item) {
            return OrderStatusEnum::REFUNDED === $item->status;
        });
        $pickedUp = $orders->filter(function ($item) {
            return OrderStatusEnum::PICKED_UP === $item->status;
        });
        $pending = $orders->filter(function ($item) {
            return OrderStatusEnum::PENDING === $item->status;
        });
        $returned = $orders->filter(function ($item) {
            return OrderStatusEnum::RETURNED === $item->status;
        });
        $closed = $orders->filter(function ($item) {
            return null !== $item->outcome_id;
        });

        $incomePaymentStatisticDto
            ->setCount($orders->count())
            ->setAmount($transactions->sum('amount'))
            ->setRefunded($refunded->count())
            ->setPickedUp($pickedUp->count())
            ->setPending($pending->count())
            ->setClosed($closed->count())
            ->setReturned($returned->count());

        return $incomePaymentStatisticDto;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
