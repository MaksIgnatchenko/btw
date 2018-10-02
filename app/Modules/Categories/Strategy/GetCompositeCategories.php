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
            $categories = $this->categoryRepository->findRootCategories();
        } else {
            $categories = $this->categoryRepository->findById($parentId);
        }

        foreach ($categories as $category) {
            $this->build($category);
        }

        return $categories;
    }

    /**
     * @param $category
     */
    protected function build($category)
    {
        $children = $this->categoryRepository->findChildCategories($category->id);

        $category->descendants = $children;

        foreach ($children as $child) {
            $this->build($child);
        }
    }
}