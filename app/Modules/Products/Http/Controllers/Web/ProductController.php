<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Products\Http\Controllers\Web;

use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Categories\Models\Category;
use App\Modules\Products\Enums\ProductStatusEnum;
use App\Modules\Products\Helpers\ProductsViewHelper;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Requests\Web\CreateProductRequest;
use App\Http\Controllers\Controller;
use App\Modules\Products\Requests\Web\EditProductRequest;
use App\Modules\Products\Requests\Web\FilterProductRequest;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class ProductController extends Controller
{
    protected $productModel;
    protected $categoryModel;
    protected $categoryRepository;
    protected $productRepository;

    /**
     * ProductController constructor.
     *
     * @param Product            $product
     * @param CategoryRepository $categoriesRepository
     * @param Category           $categoryModel
     * @param ProductRepository  $productRepository
     */
    public function __construct(
        Product $product,
        CategoryRepository $categoriesRepository,
        Category $categoryModel,
        ProductRepository $productRepository)
    {
        $this->productModel = $product;
        $this->categoryRepository = $categoriesRepository;
        $this->categoryModel = $categoryModel;
        $this->productRepository = $productRepository;

        $this->middleware('owns:product', ['only' => ['edit', 'show', 'update']]);
    }

    /**
     * Show products list.
     *
     * @param FilterProductRequest $request
     * @return View
     */
    public function index(FilterProductRequest $request): View
    {
        $productQuery = Auth::user()
            ->products()
            ->orderBy('updated_at', 'DESC');
        $status = $request->get('filter')['product-status'];

        if (in_array($status, ProductStatusEnum::getValues(), true)) {
            $productQuery->OfStatus($status);
        }

        $products = $productQuery->paginate(config('wish.store.pagination'));
        ProductsViewHelper::storeTemplateToSession();

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
     * @param Product $product
     *
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = $this->getAllowedMerchantCategoriesAsArray();

        return view('products.web.edit', [
            'categories' => $categories,
            'product' => $product,
        ]);
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

    /**
     * @param Product $product
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show(Product $product)
    {
        return view('products.web.single', [
            'product' => $product,
            'review' =>  $product->reviews()->active()->latest()->first(),
        ]);
    }

    /**
     * @param EditProductRequest $request
     * @param                    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $product->updateProduct($request->all());

        return redirect()->route('products.show', ['product' => $product]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Product $product)
    {
        $status = $product->status === ProductStatusEnum::ACTIVE
           ? ProductStatusEnum::ARCHIVED
           : ProductStatusEnum::ACTIVE;
        $product->updateProduct(['status' => $status]);

        return response()->json([
            'success' => true,
            'status' => $status,
            'text' => ProductStatusEnum::toArray()[$product->status]
        ]);
    }
}
