<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 12.12.2017
 */

namespace App\Modules\Categories\Helpers;

use App\Modules\Categories\Models\Category;

class CategoriesHelper
{
    /**
     * @param Category $categoryModel
     *
     * @return bool
     */
    public static function canDelete(Category $categoryModel): bool
    {
        if (!$categoryModel->products->isEmpty()) {
            return false;
        }

        if ($categoryModel->is_final) {
            return true;
        }

        if (!$categoryModel->categories->isEmpty()) {
            return false;
        }

        return true;
    }
}
