<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 05.11.2018
 */

namespace App\Modules\Categories\Http\Controllers\Service;

use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Categories\Models\Category;

class AttributeController
{
    protected $categoryModel;

    /**
     * AttributeController constructor.
     *
     * @param Category $categoryModel
     */
    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category)
    {
        return response($category->attributes);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAsTree()
    {
        return response()->json([
            'categories' => $this->categoryModel->buildCategoriesTree(Category::all()),
        ]);
    }
}
