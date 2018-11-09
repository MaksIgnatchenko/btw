<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Products\Http\Controllers\Web;

use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Requests\Web\CreateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class ProductController extends Controller
{
    protected $productModel;
    protected $categoryModel;
    protected $categoryRepository;

    /**
     * ProductController constructor.
     * @param Product $product
     * @param CategoryRepository $categoriesRepository
     * @param Category $categoryModel
     */
    public function __construct(Product $product, CategoryRepository $categoriesRepository, Category $categoryModel)
    {
        $this->productModel = $product;
        $this->categoryRepository = $categoriesRepository;
        $this->categoryModel = $categoryModel;
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
        $storeCategories = Auth::user()->store->categories;

        $childCategories = $this->categoryRepository->findAllChildCategories();
        $result = $childCategories->merge($storeCategories);

        $categoriesTree = $this->categoryModel->buildCategoriesTree($result);

        return view('products.web.create', ['categories' => $categoriesTree]);
    }

    /**
     * Create new product.
     *
     * @param CreateProductRequest $request
     * @return CreateProductRequest
     */
    public function store(CreateProductRequest $request)
    {
        $storeId = Auth::user()->store->id;

        $this->productModel->createProduct($request->all(), $storeId);

        Flash::success('Product has been created successfully');

        return redirect(route('products.index'));
    }
}
