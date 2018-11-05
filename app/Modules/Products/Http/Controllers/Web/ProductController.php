<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Products\Http\Controllers\Web;

use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Requests\Web\CreateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productModel;

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    /**
     * Show products list.
     *
     * @return View
     */
    public function index(): View
    {
        return view('products.web.index');
    }

    /**
     * Show add new product page.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::where('is_final', '1')->pluck('name', 'id');

        return view('products.web.create', ['categories' => $categories]);
    }

    /**
     * Create new product.
     *
     * @param CreateProductRequest $request
     * @return CreateProductRequest
     */
    public function store(CreateProductRequest $request)
    {
        $this->productModel->createProduct($request->all());

        //TODO Create store method;
    }
}
