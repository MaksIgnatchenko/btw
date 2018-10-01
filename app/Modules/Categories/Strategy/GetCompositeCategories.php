<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 28.9.2018
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

class GetCompositeCategories extends AbstractGetCategories implements GetCategoriesInterface
{
    protected $result;

    /**
     * @param int $parentId
     *
     * @return Collection
     */
    public function getCategories(int $parentId = null): Collection
    {
        if (!$parentId) {
            $root = $this->categoryRepository->findRootCategories();
        } else {
            $root = $this->categoryRepository->findById($parentId);
        }

        foreach ($root as $category) {
            $this->build($category);
        }

        return $root;
    }

    public function build($category)
    {
        $children = $this->categoryRepository->findChildCategories($category->id);

        foreach ($children as $child) {
            $category->children = $children;
            $this->build($child);
        }
    }
}