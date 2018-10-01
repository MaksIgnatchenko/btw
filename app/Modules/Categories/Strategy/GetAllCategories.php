<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 28.9.2018
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

class GetAllCategories extends AbstractGetCategories implements GetCategoriesInterface
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
            $rootCategories = $this->categoryRepository->findRootCategories();



            foreach ($rootCategories as $category) {
                $this->result[$category->id] = $category->toArray();
                $this->addCategories($category, $this->result[$category->id]);
            }
        }

        dd($this->result);

    }

    public function addCategories($category, &$builderArray)
    {

        $children = $this->categoryRepository->findChildCategories($category->id);

        foreach ($children as $child) {
            $builderArray["children"][$child->id] = $child->toArray();
            $this->addCategories($child, $builderArray["children"][$child->id]);
        }



    }

}