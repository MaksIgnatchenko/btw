<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 9.10.2018
 */

namespace App\Modules\Products\Filter\Particular;

use App\Filters\ParticularFilterInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class FromCreationDaysFilter implements ParticularFilterInterface
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->where('created_at', '>=', Carbon::now()->subDays($value));
    }

}