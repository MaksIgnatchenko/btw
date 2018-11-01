<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Products\Http\Controllers\Web;

use App\Modules\Categories\Models\Category;
use App\Modules\Products\Requests\Web\CreateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('products.web.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all()->pluck('name', 'id');

        return view('products.web.create', ['categories' => $categories]);
    }

    public function store(CreateProductRequest $request)
    {
        return $request;
    }
}
