<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.01.2018
 */

namespace App\Modules\Products\Repositories;

use App\Modules\Products\Enums\TransactionStatusEnum;
use App\Modules\Products\Models\Transaction;
use Illuminate\Support\Collection;
use InfyOm\Generator\Common\BaseRepository;

class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'amount',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Transaction::class;
    }

    /**
     * @param Transaction $model
     */
    public function save(Transaction $model): void
    {
        $model->save();
    }

    /**
     * @return Collection
     */
    public function findActive(): Collection
    {
        return Transaction::where(['status' => TransactionStatusEnum::SUCCESS])->get();

    }
}
