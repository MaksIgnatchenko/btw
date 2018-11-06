<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 5.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Requests\GetMerchantProductsRequest;

class MerchantProductController extends Controller
{
    /** @var Product */
    protected $productModel;

    /**
     * MerchantController constructor.
     *
     * @param $productModel
     */
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * @param GetMerchantProductsRequest $request
     * @param Merchant                   $merchant
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetMerchantProductsRequest $request, Merchant $merchant)
    {
        $products = $this->productModel->getOtherMerchantProducts(
            0,
            $merchant->id,
            $request->get('offset', 0));

        return response()->json([
            'products' => $products,
        ]);
    }
}