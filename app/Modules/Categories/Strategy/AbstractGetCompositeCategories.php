<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 3.10.2018
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

class AbstractGetCompositeCategories extends AbstractGetCategories implements GetCategoriesInterface
{
    protected $root;

    /**
     * @param int $parentId
     *
     * @return Collection
     */
    public function getCategories(int $parentId = null): Collection
    {
        foreach ($this->root as $category) {
            $this->attachChildren($category);
        }

        return $this->root;
    }

    /**
     * @param $category
     */
    public function attachChildren($category)
    {
        $children = $this->categoryRepository->findChildCategories($category->id);

        $category->children = $children;

        foreach ($children as $child) {
            $this->attachChildren($child);
        }
    }
}