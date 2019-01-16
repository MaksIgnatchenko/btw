<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 17.11.2017
 */

namespace App\Modules\Products\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Dto\CoordinatesDto;
use App\Modules\Products\Dto\CustomerSearchDto;
use App\Modules\Products\Enums\ProductFiltersEnum;
use App\Modules\Products\Events\AddProductEvent;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\ProductImage;
use App\Modules\Products\Models\ProductLocalDelivery;
use App\Modules\Products\Repositories\ProductImageRepository;
use App\Modules\Products\Repositories\ProductLocalDeliveryRepository;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Requests\Api\CustomerSearchRequest;
use App\Modules\Products\Requests\Api\GetPopularRequest;
use App\Modules\Products\Requests\Api\GetPriceBreakersRequest;
use App\Modules\Products\Requests\Api\GetProductsRequest;
use App\Modules\Products\Requests\Api\OtherMerchantProductsRequest;
use App\Modules\Products\Requests\Api\SetProductRequest;
use App\Modules\Products\Requests\Api\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /** @var  ProductRepository */
    protected $productRepository;
    /** @var  ProductImageRepository */
    protected $productImageRepository;
    /** @var  Product */
    protected $product;
    /** @var  ProductImage */
    protected $productImage;

    /**
     * ContentController constructor.
     *
     * @param ProductRepository $productRepository
     * @param ProductImageRepository $productImageRepository
     * @param Product $product
     * @param ProductImage $productImage
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductImageRepository $productImageRepository,
        Product $product,
        ProductImage $productImage
    )
    {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;

        $this->product = $product;
        $this->productImage = $productImage;
    }

    /**
     * @param GetPopularRequest $request
     *
     * @return JsonResponse
     */
    public function popular(GetPopularRequest $request): JsonResponse
    {
        $offset = $request->get('offset', 0);

        $products = $this->productRepository->getPopular($offset);

        return response()->json(['products' => $products]);
    }

    /**
     * @param CustomerSearchRequest $request
     *
     * @return JsonResponse
     * @throws \App\Modules\Categories\Exceptions\NotFountCategory
     */
    public function customerSearch(CustomerSearchRequest $request): JsonResponse
    {
        /** @var CustomerSearchDto $customerSearchDto */
        $customerSearchDto = app()[CustomerSearchDto::class];

        $customerSearchDto->setOffset($request->get('offset', 0))
            ->setCategoryIds($request->get('category', []))
            ->setKeyword($request->get('keyword'))
            ->setOrder($request->get('order'))
            ->setFilters($request->only(ProductFiltersEnum::toArray()));

        /** @var Product $productModel */
        $productModel = app()[Product::class];
        $products = $productModel->customerSearch($customerSearchDto);

        return response()->json(['products' => $products]);
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $product = $this->productRepository->getById((int)$id);
        $product->category->setVisible(['id', 'name']);

        if (null === $product) {
            return response()->json([
                'product' => new \stdClass(),
            ]);
        }

        return response()->json([
            'product' => $product,
        ]);
    }
}
