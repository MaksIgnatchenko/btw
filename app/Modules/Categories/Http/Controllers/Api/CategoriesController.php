<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Categories\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Strategy\CategoriesStrategy;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    /** @var CategoriesStrategy */
    protected $categoriesStrategy;

    /**
     * CategoriesController constructor.
     *
     * @param CategoriesStrategy $categoriesStrategy
     */
    public function __construct(
        CategoriesStrategy $categoriesStrategy
    ) {
        $this->categoriesStrategy = $categoriesStrategy;
    }

    /**
     * @param null $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoriesAction($id = null): JsonResponse
    {
        $categories = $this->categoriesStrategy->getCategories($id);

        return response()->json([
            'categories' => $categories,
        ]);
    }
}
