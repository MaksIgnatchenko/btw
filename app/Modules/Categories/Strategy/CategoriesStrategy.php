<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

class CategoriesStrategy
{
    /**
     * @param int|null $parentId
     *
     * @return Collection
     */
    public function getCategories(int $parentId = null): Collection
    {
        $strategy = new GetCompositeCategories();

        return $strategy->getCategories($parentId);
    }
}
