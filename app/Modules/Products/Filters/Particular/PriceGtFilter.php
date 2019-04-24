<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 10.10.2018
 */

namespace App\Modules\Products\Filters\Particular;

use App\Modules\Products\Filters\ParticularFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class PriceGtFilter implements ParticularFilterInterface
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->where('products.price' , '>', $value);
    }

}