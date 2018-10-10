<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 9.10.2018
 */

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * @param Builder $builder
     *
     * @return mixed
     */
    public function filter(Builder $builder);
}