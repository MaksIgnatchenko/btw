<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 3.10.2018
 */

namespace App\Modules\Categories\Strategy;

use Illuminate\Database\Eloquent\Collection;

class GetSingleCompositeCategories extends AbstractGetCompositeCategories implements GetCategoriesInterface
{
    /**
     * GetSingleCompositeCategories constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        parent::__construct();
        $this->root = $categories = $this->categoryRepository->findById($id);
    }
}
