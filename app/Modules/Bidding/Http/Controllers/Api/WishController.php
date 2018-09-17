<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Bidding\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Bidding\Dto\WishFilterDto;
use App\Modules\Bidding\Events\AddToWishListEvent;
use App\Modules\Bidding\Factories\FilterFactoryFactory;
use App\Modules\Bidding\Http\Requests\Api\CreateWishRequest;
use App\Modules\Bidding\Http\Requests\Api\GetWishesRequest;
use App\Modules\Bidding\Models\Wish;
use App\Modules\Categories\Exceptions\NotFountCategory;
use App\Modules\Users\Models\Customer;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    /**
     * @param GetWishesRequest $request
     *
     * @return JsonResponse
     * @throws \App\Modules\Bidding\Exceptions\WrongFilterException
     */
    public function index(GetWishesRequest $request): JsonResponse
    {
        $user = Auth::user();
        $role = $user->roles()->get()[0];
        $filterName = $request->get('filter');

        /** @var WishFilterDto $wishFilterDto */
        $wishFilterDto = app()->make(WishFilterDto::class, ['filter' => $filterName]);
        $wishFilterDto->setCategoryId($request->get('category_id'))
            ->setName($request->get('name'))
            ->setBarcode($request->get('barcode'))
            ->setCoordinates($request->get('latitude'), $request->get('longitude'))
            ->setOffset($request->get('offset', 0))
            ->setDistance($request->get('distance'));

        $filterFactory = FilterFactoryFactory::get($role->name);

        try {
            $filter = $filterFactory->get($filterName);
            $wishes = $filter->get($wishFilterDto);
        } catch (NotFountCategory $exception) {
            $wishes = collect([]);
        }

        return response()->json([
            'wishes' => $wishes,
        ]);
    }

    /**
     * @param CreateWishRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function store(CreateWishRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Customer $customer */
        $customer = $user->customer;
        /** @var Wish $wish */
        $wish = app(Wish::class);
        $productId = $request->get('product_id');
        $bidEnd = $request->get('bid_end');

        $wish->fill($request->all());
        $wish->create($customer, $productId, $bidEnd);

        $addToWithListEvent = app(AddToWishListEvent::class, ['wish' => $wish]);
        event($addToWithListEvent);

        return response()->json(['success' => true]);
    }
}
