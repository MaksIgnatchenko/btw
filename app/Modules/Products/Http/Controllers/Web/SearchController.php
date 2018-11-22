<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 14.11.2018
 */

namespace App\Modules\Products\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Requests\Web\SearchProductsRequest;
use Illuminate\Support\Facades\Auth;
use App\Modules\Products\Helpers\ProductsViewHelper;

class SearchController extends Controller
{
    protected $productModel;

    /**
     * SearchController constructor.
     * @param Product $productModel
     */
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * @param SearchProductsRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SearchProductsRequest $request)
    {
        $searchText = $request->get('search');
        $storeId = Auth::user()->store->id;
        ProductsViewHelper::storeTemplateToSession();

        $products = $this->productModel->search($storeId, $searchText);

        return view('products.web.index', ['products' => $products, 'searchText' => $searchText]);
    }
}
