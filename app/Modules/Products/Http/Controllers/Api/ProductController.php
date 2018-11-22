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
     * @param ProductRepository      $productRepository
     * @param ProductImageRepository $productImageRepository
     * @param Product                $product
     * @param ProductImage           $productImage
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductImageRepository $productImageRepository,
        Product $product,
        ProductImage $productImage
    )
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;

        $this->product = $product;
        $this->productImage = $productImage;
    }

    /**
     * @param SetProductRequest $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function set(SetProductRequest $request): JsonResponse
    {
        /** @var ProductLocalDelivery $productLocalDelivery */
        $productLocalDelivery = app(ProductLocalDelivery::class);
        /** @var ProductLocalDeliveryRepository $productLocalDeliveryRepository */
        $productLocalDeliveryRepository = app(ProductLocalDeliveryRepository::class);
        $mainImage = $request->file('main_image');
        $mainImage->store(ProductImage::IMAGES_STORE_PATH);
        // todo move into event from controller
        $thumb = $this->productImage->getMainImageThumb($mainImage);
        $thumb->save(storage_path(ProductImage::IMAGES_STORE_THUMBS_PATH . $mainImage->hashName()));

        $productData = array_merge($request->all(), [
            'main_image' => $mainImage->hashName(),
            'user_id' => Auth::id(),
        ]);
        $this->product->fill($productData);
        $this->productRepository->save($this->product);

        $productLocalDelivery->fill([
            'product_id' => $this->product->id,
            'active' => $request->get('local_delivery'),
            'distance' => $request->get('local_delivery_distance', 0),
        ]);
        $productLocalDeliveryRepository->save($productLocalDelivery);

        $addProductEvent = (new AddProductEvent())->setProduct($this->product);
        event($addProductEvent);

        $images = $request->file('images');
        if (!$images) {
            return response()->json(['success' => true]);
        }

        $this->productImage->saveImages($images, $this->product->id);

        return response()->json(['success' => true]);
    }


    /**
     * @param GetProductsRequest $request
     *
     * @return JsonResponse
     * @throws \App\Modules\Products\Exceptions\WrongStatusException
     */
    public function get(GetProductsRequest $request): JsonResponse
    {
        $filter = $request->get('filter');
        $offset = $request->get('offset');
        $userId = Auth::id();

        $products = $this->product->getProductsByFilter($filter, $userId, $offset);

        return response()->json(['products' => $products]);
    }

    /**
     * @param GetPriceBreakersRequest $request
     *
     * @return JsonResponse
     */
    public function priceBreakers(GetPriceBreakersRequest $request): JsonResponse
    {
        $offset = $request->get('offset', 0);
        $coordinates = new CoordinatesDto();
        $coordinates
            ->setLatitude($request->get('latitude', 0))
            ->setLongitude($request->get('longitude', 0));

        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];
        $userIds = null;
        if (!$coordinates->isEmpty()) {
            $userIds = $this->merchantRepository->getInRadius(
                $coordinates->getLongitude(),
                $coordinates->getLatitude(),
                Product::DEFAULT_RADIUS
            )
                ->pluck('user_id')
                ->sortBy('distance')
                ->toArray();
        }
        $products = $productRepository->getPriceBreakers($offset, $userIds);

        return response()->json(['products' => $products]);
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
    public function getSingle(string $id): JsonResponse
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app()[ProductRepository::class];
        $product = $productRepository->getById((int)$id);
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

    /**
     * @param UpdateProductRequest $request
     *
     * @return JsonResponse
     * @internal param string $id
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(UpdateProductRequest $request): JsonResponse
    {
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);
        /** @var ProductImageRepository $productImageRepository */
        $productImageRepository = app(ProductImageRepository::class);
        /** @var ProductImage $productImageModel */
        $productImageModel = app(ProductImage::class);
        /** @var ProductLocalDeliveryRepository $productLocalDeliveryRepository */
        $productLocalDeliveryRepository = app(ProductLocalDeliveryRepository::class);

        /** @var User $user */
        $user = Auth::user();
        /** @var Product $product */
        $product = $productRepository->find($request->get('product_id'));
        // TODO maybe move check permissions from controller
        if (!$user->owns($product)) {
            abort(403, 'You can edit only your own products');
        }

        $productImageRepository->deleteByProductId($product->id);
        // todo move into event from controller
        $mainImage = $request->file('main_image');
        $mainImage->store(ProductImage::IMAGES_STORE_PATH);

        $thumb = $this->productImage->getMainImageThumb($mainImage);
        $thumb->save(storage_path(ProductImage::IMAGES_STORE_THUMBS_PATH . $mainImage->hashName()));

        $productData = array_merge($request->all(), [
            'main_image' => $mainImage->hashName(),
        ]);

        $product->fill($productData);
        $productRepository->save($product);

        $productLocalDeliveryRepository->updateOrCreate(
            ['product_id' => $product->id],
            [
                'active' => $request->get('local_delivery'),
                'distance' => $request->get('local_delivery_distance', 0),
            ]
        );

        $images = $request->file('images');
        if (!$images) {
            return response()->json(['success' => true]);
        }
        $productImageModel->saveImages($images, $product->id);

        return response()->json(['success' => true]);
    }

    /**
     * @param OtherMerchantProductsRequest $request
     *
     * @return JsonResponse
     */
    public function otherMerchantProducts(OtherMerchantProductsRequest $request): JsonResponse
    {
        $productId = $request->get('product_id');
        $merchantId = $request->get('merchant_id');
        $offset = $request->get('offset', 0);


        /** @var Product $productModel */
        $productModel = app(Product::class);
        $products = $productModel->getOtherMerchantProducts($productId, $merchantId, $offset);

        return response()->json([
            'products' => $products,
        ]);
    }
}
