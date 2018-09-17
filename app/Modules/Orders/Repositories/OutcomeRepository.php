<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Orders\Repositories;

use App\Modules\Csv\Generator\DateDto;
use App\Modules\Csv\Generator\GetInRangeInterface;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\Outcome;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Common\BaseRepository;

class OutcomeRepository extends BaseRepository implements GetInRangeInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Outcome::class;
    }

    /**
     * @param Outcome $outcome
     * @param array $orderIds
     */
    public function updateWithOrders(Outcome $outcome, array $orderIds): void
    {
        $outcome->save();
        Order::where(['outcome_id' => $outcome->id])->update(['outcome_id' => null]);
        Order::whereIn('id', $orderIds)->update(['outcome_id' => $outcome->id]);
    }

    /**
     * @param DateDto $dateDto
     *
     * @return Collection
     */
    public function getInRange(DateDto $dateDto): Collection
    {
        return Outcome::query()
            ->select([
                DB::raw('DATE_FORMAT(payment_date, "%e %b %Y") as "Payment date"'),
                'amount as Amount',
                'net_amount as Net amount',
                'merchants.business_name as Merchant',
                DB::raw('CONCAT(customers.first_name," ", customers.last_name) AS Customer'),
            ])
            ->leftJoin('merchants', 'outcome.merchant_id', '=', 'merchants.id')
            ->leftJoin('orders', 'outcome.id', '=', 'orders.outcome_id')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('outcome.created_at', [$dateDto->getDateFrom(), $dateDto->getDateTo()])
            ->get();
    }
}
