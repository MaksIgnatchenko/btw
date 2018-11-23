<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 11.01.2018
 */

namespace App\Modules\Orders\Models;

use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Exceptions\WrongOrderStatusException;
use App\Modules\Orders\Exceptions\WrongReturnDetailsException;
use App\Modules\Orders\Helpers\OrderChecker;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Models\Transaction;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Merchant\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    public const PAGE_LIMIT = 50;

    protected $fillable = [
        'customer_id',
        'merchant_id',
        'transaction_id',
        'product',
        'quantity',
        'qr_code',
        'status',
        'created_at',
        'updated_at',
        'delivery_option',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'customer_id'     => 'integer',
        'merchant_id'     => 'integer',
        'transaction_id'  => 'string',
        'delivery_option' => 'string',

        'product'  => 'object',
        'quantity' => 'integer',
        'qr_code'  => 'string',
        'status'   => 'string',
    ];

    /**
     * @throws WrongOrderStatusException
     * @throws WrongReturnDetailsException
     */
    public function updateStatus(): void
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);

        $this->setStatus();
        $this->redeemed_at = Carbon::now();
        $orderRepository->save($this);
    }

    /**
     * @throws WrongOrderStatusException
     * @throws WrongReturnDetailsException
     */
    protected function setStatus(): void
    {
        if (OrderStatusEnum::PENDING === $this->status) {
            $this->status = OrderStatusEnum::PICKED_UP;

            return;
        }
        if (OrderStatusEnum::PICKED_UP === $this->status) {

            if (!OrderChecker::checkReturnDetails($this)) {
                throw  new WrongReturnDetailsException('Sorry, No return is accepted after the return period');
            }

            $this->status = OrderStatusEnum::RETURNED;

            return;
        }

        throw new WrongOrderStatusException('Order should have pending or picked_up status to update');
    }

    /**
     * @param int $merchantId
     *
     * @return Collection
     */
    public function getMerchantNotPaidOrders(int $merchantId): Collection
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);

        return $orderRepository->findMerchantNotPaidOrders($merchantId);
    }

    /**
     * @return int
     */
    public function getAmountAttribute(): int
    {
        return $this->quantity * $this->product->price;
    }

    /**
     * @param int $merchantId
     * @param string $searchText
     * @return LengthAwarePaginator
     */
    public function search(int $merchantId, string $searchText): LengthAwarePaginator
    {
        $orderRepository = app()[OrderRepository::class];

        return $orderRepository->findMerchantOrdersBySearchTextWithPagination($merchantId, $searchText);
    }


    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeForCustomer($query)
    {
        return $query->with([
            'customer' => function ($query) {
                $query->select(['id', 'user_id', 'first_name', 'last_name'])->with([
                    'user'            => function ($query) {
                        $query->select(['id', 'username', 'email']);
                    },
                    'deliveryAddress' => function ($query) {
                        $query->select(['customer_id', 'address', 'longitude', 'latitude']);
                    }
                ]);
            }
        ]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithoutQrCode($query)
    {
        return $query->select([
            'customer_id',
            'merchant_id',
            'product',
            'quantity',
            'status',
            'created_at',
            'delivery_option',
        ]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopewithAmount($query)
    {
        return $query->select([
            'orders.*',
            DB::raw('TRUNCATE(product->\'$."price"\' * quantity, 2) as amount'),
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
