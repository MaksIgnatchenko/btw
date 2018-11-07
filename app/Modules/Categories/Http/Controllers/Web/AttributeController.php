<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 05.11.2018
 */

namespace App\Modules\Categories\Http\Controllers\Web;

use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Categories\Models\Category;

class AttributeController
{
    protected $categoryRepository;

    /**
     * AttributeController constructor.
     * @param CategoryRepository $categoriesRepository
     */
    public function __construct(CategoryRepository $categoriesRepository)
    {
        $this->categoryRepository = $categoriesRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (null === $category) {
            //TODO change response
            return response()->json([
                'error' => 404,
                'message' => 'No such category',
            ]);
        }

        return response($category->attributes);
    }
}