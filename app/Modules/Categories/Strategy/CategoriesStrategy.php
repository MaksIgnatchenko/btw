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
        if (null === $parentId) {
            $strategy = new GetRootCategories();
        } else {
            $strategy = new GetChildCategories();
        }

        return $strategy->getCategories($parentId);
    }
}
