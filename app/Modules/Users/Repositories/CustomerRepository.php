<?php

namespace App\Modules\Users\Repositories;

use App\Modules\Csv\Generator\DateDto;
use App\Modules\Csv\Generator\GetInRangeInterface;
use App\Modules\Users\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository extends UserTypeRepositoryAbstract implements GetInRangeInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'user.email',
        'user.username',
        'created_at',
    ];

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Customer::class;
    }

    /**
     * @param DateDto $dateDto
     *
     * @return Collection
     */
    public function getInRange(DateDto $dateDto): Collection
    {
        return Customer::query()
            ->select([
                'customers.first_name as First name',
                'customers.last_name as Last name',
                'users.email as Email',
                'users.username as Username',
                'customers.status as Status',
            ])
            ->selectRaw('DATE_FORMAT(customers.created_at, "%e %b %Y")  as Registered')
            ->whereBetween('customers.created_at', [
                $dateDto->getDateFrom(),
                (new Carbon($dateDto->getDateTo()))->addDays(1),
            ])
            ->leftJoin('users', 'users.id', '=', 'customers.user_id')
            ->get();
    }
}
