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
     *
     * @param Product            $product
     * @param CategoryRepository $categoriesRepository
     * @param Category           $categoryModel
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
        $products = Auth::user()->products()->paginate(config('wish.store.pagination'));

        return view('products.web.index', ['products' => $products]);
    }

    /**
     * Show add new product page.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = $this->getAllowedMerchantCategoriesAsArray();

        return view('products.web.create', ['categories' => $categories]);
    }

    /**
     * Returns one-dimensional array [id => name] of all categories, recurrently from root to final,
     * available for current merchant`s shop
     *
     * @return array
     */
    protected function getAllowedMerchantCategoriesAsArray(): array
    {
        $storeCategories = Auth::user()->store->categories;

        $childCategories = $this->categoryRepository->findAllChildCategories();
        $result = $childCategories->merge($storeCategories);

        $categoriesTree = $this->categoryModel->buildCategoriesTree($result);

        $handle = function ($categories) use (&$handle) {
            $result = [];

            foreach ($categories as $category) {
                $result[$category->id] = $category->name;
                if ($category->children) {
                    $recursionResult = $handle($category->children);
                    $result += $recursionResult;
                    continue;
                }
            }

            return $result;
        };

        return $handle($categoriesTree);
    }

    /**
     * Create new product.
     *
     * @param CreateProductRequest $request
     *
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
