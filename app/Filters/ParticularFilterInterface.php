<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 9.10.2018
 */

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

interface ParticularFilterInterface
{
    /**
     * @param Builder $builder
     * @param         $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value): Builder;
}