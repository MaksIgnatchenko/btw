<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Products\Exceptions\ProductAlreadyAddedException;
use App\Modules\Products\Factory\AddToCart\AddToCartFactory;
use App\Modules\Products\Factory\ChangeQuantityFactory;
use App\Modules\Products\Models\Cart;
use App\Modules\Products\Repositories\CartRepository;
use App\Modules\Products\Requests\Api\CheckCartRequest;
use App\Modules\Products\Requests\Api\CreateCartRequest;
use App\Modules\Products\Requests\Api\UpdateCartRequest;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        /** @var User $user */
        $user = Auth::user();
        $customerId = $user->customer->id;

        $carts = $cartRepository->findCartsWithProducts($customerId);
        $carts->each(function ($item, $key) {
            $item->productRelation->setVisible(['parameters']);
        });

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
        /** @var User $user */
        $user = Auth::user();
        $customer = $user->customer;
        $source = $request->get('source');
        $deliveryOption = $request->get('delivery_option', CartDeliveryOptionEnum::STORE_DELIVERY);

        // TODO move to model
        $itemId = $request->get('product_id');
        if (CartSourceEnum::BID === $source) {
            $itemId = $request->get('bid_id');
        }

        /** @var AddToCartFactory $factory */
        $factory = app(AddToCartFactory::class);

        try {
            $addToCart = $factory->get($source, $customer->id, $itemId, $deliveryOption);
            $addToCart->execute();
        } catch (ProductAlreadyAddedException $e) {
            return response()->json([
                'message' => 'The given data is invalid',
                'errors'  => [
                    'product_id' => ['This product is already added to cart'],
                ],
            ], 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param UpdateCartRequest $request
     * @param int $cartId
     *
     * @return JsonResponse
     * @throws \App\Modules\Products\Exceptions\WrongOperationActionException
     */
    public function update(UpdateCartRequest $request, int $cartId): JsonResponse
    {
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        /** @var Cart $cart */
        $cart = $cartRepository->findWithoutFail($cartId);

        $this->checkCart($cart);
        if (CartSourceEnum::PRODUCT !== $cart->source) {
            abort(403, 'You can edit only when source product');
        }

        $operation = ChangeQuantityFactory::getOperation($request->get('action'));
        $operation->make($cart);

        return response()->json(['success' => true]);
    }

    /**
     * @param int $cartId
     *
     * @return JsonResponse
     * @throws \App\Modules\Products\Exceptions\WrongOperationActionException
     */
    public function delete(int $cartId): JsonResponse
    {
        /** @var CartRepository $cartRepository */
        $cartRepository = app(CartRepository::class);
        /** @var Cart $cart */
        $cart = $cartRepository->findWithoutFail($cartId);

        $this->checkCart($cart);

        $cartRepository->delete($cartId);

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

        /** @var User $user */
        $user = Auth::user();
        /** @var Customer $customer */
        $customer = $user->customer;

        if (!$customer->owns($cart, 'customer_id')) {
            abort(403, 'You can edit only your own carts');
        }
    }
}
