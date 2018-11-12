<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 12.11.2018
 */

namespace App\Modules\Categories\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    /** @var Category */
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAsTree(): JsonResponse
    {
        return response()->json([
            'categories' => $this->categoryModel->buildCategoriesTree(Category::all()),
        ]);
    }
}
