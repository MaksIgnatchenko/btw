<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 28.9.2018
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

class GetRootCompositeCategories extends AbstractGetCompositeCategories implements GetCategoriesInterface
{
    /**
     * GetCompositeCategories constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->root = $this->categoryRepository->findRootCategories();
    }
}
