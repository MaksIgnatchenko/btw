<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 1.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Requests\GetMerchantProductsRequest;

class MerchantController extends Controller
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


    public function get(Merchant $merchant)
    {
        $merchant = $merchant->load('store');

        return response()->json([
            'merchant' => $merchant,
        ]);
    }

    public function getProducts(GetMerchantProductsRequest $request, Merchant $merchant)
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
