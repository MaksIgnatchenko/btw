<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Exceptions\ProductAlreadyAddedException;
use App\Modules\Products\Factory\AddToCart\AddProduct;
use App\Modules\Products\Models\Cart;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Requests\Api\CheckCartRequest;
use App\Modules\Products\Requests\Api\CreateCartRequest;
use App\Modules\Products\Requests\Api\UpdateCartRequest;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /** @var CartRepository */
    protected $cartRepository;

    /** @var ProductRepository */
    protected $productRepository;

    /**
     * CartController constructor.
     *
     * @param CartRepository $cartRepository
     */
    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $customerId = Auth::id();
        $carts = $this->cartRepository->findCartsWithProducts($customerId);

        return response()->json(['cart' => $carts]);
    }

    /**
     * @param CreateCartRequest $request
     *
     * @return JsonResponse
     * @throws \App\Modules\Products\Exceptions\WrongSourceException
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function create(CreateCartRequest $request): JsonResponse
    {
        $customerId = Auth::id();

        try {
            $product = $this->productRepository->find($request->product_id);
            $cart = $this->cartRepository->findCartByConditions($product->id, $customerId);

            if (null !== $cart) {
                throw new ProductAlreadyAddedException('This product is already added to cart');
            }

            (new AddProduct($product, $customerId))->execute();
        } catch (ProductAlreadyAddedException $e) {
            return response()->json([
                'message' => 'The given data is invalid',
                'errors' => [
                    'product_id' => $e->getMessage(),
                ],
            ], 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param UpdateCartRequest $request
     * @param int               $cartId
     *
     * @return JsonResponse
     */
    public function update(UpdateCartRequest $request, int $cartId): JsonResponse
    {
        /** @var Cart $cart */
        $cart = $this->cartRepository->findWithoutFail($cartId);

        $this->checkCart($cart);

        if (
            $request->quantity <= $cart->product->quantity &&
            $request->quantity >= Cart::PRODUCT_MIN_QUANTITY
        ) {
            $cart->quantity = $request->quantity;
            $this->cartRepository->save($cart);

            return response()->json(['success' => true]);
        }

        return response()->json([
            'message' => 'The given data is invalid',
            'errors' => [
                'quantity' => 'Quantity must be a value between 1 and product quantity',
            ],
        ], 422);
    }

    /**
     * @param int $cartId
     *
     * @return JsonResponse
     * @throws \App\Modules\Products\Exceptions\WrongOperationActionException
     */
    public function delete(int $cartId): JsonResponse
    {
        $cart = $this->cartRepository->findWithoutFail($cartId);

        $this->checkCart($cart);

        $this->cartRepository->delete($cartId);

        return response()->json(['success' => true]);
    }

    /**
     * @param CheckCartRequest $request
     *
     * @return JsonResponse
     */
    public function check(CheckCartRequest $request): JsonResponse
    {
        return response()->json(['success' => true]);
    }

    /**
     * @param Cart $cart
     */
    protected function checkCart(Cart $cart = null): void
    {
        if (null === $cart) {
            abort(401, 'No such cart');
        }

        /** @var Customer $customer */
        $customer = Auth::user();

        if (!$customer->owns($cart, 'customer_id')) {
            abort(403, 'You can edit only your own carts');
        }
    }
}
