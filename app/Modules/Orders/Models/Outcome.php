<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.01.2018
 */

namespace App\Modules\Orders\Models;

use App\Modules\Orders\Dto\OutcomeStatisticDto;
use App\Modules\Orders\Repositories\OutcomeRepository;
use App\Modules\Users\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outcome extends Model
{
    public const DEFAULT_FEE = 7;

    protected $table = 'outcome';

    protected $fillable = [
        'amount',
        'payment_type',
        'merchant_id',
        'payment_date',
        'fee',
        'net_amount',
    ];

    protected $casts = [
        'amount'       => 'float',
        'payment_type' => 'string',
        'merchant_id'  => 'integer',
        'payment_date' => 'datetime',
        'fee'          => 'float',
        'net_amount'   => 'float',
    ];

    /**
     * @return OutcomeStatisticDto
     */
    public function getStatistic(): OutcomeStatisticDto
    {
        /** @var OutcomeRepository $outcomeRepository */
        $outcomeRepository = app(OutcomeRepository::class);
        /** @var OutcomeStatisticDto $statistic */
        $statistic = app(OutcomeStatisticDto::class);
        $outcome = $outcomeRepository->all();

        $count = $outcome->count();
        $amount = $outcome->sum('amount');

        return $statistic->setAmount($amount)->setCount($count);
    }

    /**
     * @throws \Exception
     */
    public function drop(): void
    {
        /** @var OutcomeRepository $outcomeRepository */
        $outcomeRepository = app(OutcomeRepository::class);
        $outcomeRepository->updateWithOrders($this, []);
        $this->delete();
    }

    /**
     * @param $value
     */
    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
