<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 03.04.2018
 */

namespace App\Modules\Csv\Generator;

use Illuminate\Database\Eloquent\Collection;

interface GetInRangeInterface
{
    /**
     * @param DateDto $dateDto
     *
     * @return Collection
     */
    public function getInRange(DateDto $dateDto): Collection;
}
