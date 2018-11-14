<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 05.11.2018
 */

namespace App\Modules\Categories\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Models\Category;

class AttributeController extends Controller
{
    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category)
    {
        return response($category->attributes);
    }
}
