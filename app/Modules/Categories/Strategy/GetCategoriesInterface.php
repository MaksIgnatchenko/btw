<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

interface GetCategoriesInterface
{
    /**
     * @param int $parentId
     *
     * @return Collection
     */
    public function getCategories(int $parentId = null): Collection;
}
