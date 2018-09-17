<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.02.2018
 */

namespace App\Modules\Bidding\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Bidding\Http\Requests\Api\StoreDeclinedWishRequest;
use App\Modules\Bidding\Repositories\DeclinedWishRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DeclinedWishController extends Controller
{
    /**
     * @param StoreDeclinedWishRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDeclinedWishRequest $request): JsonResponse
    {
        $user = Auth::user();
        $merchant = $user->merchant;

        /** @var DeclinedWishRepository $repository */
        $repository = app(DeclinedWishRepository::class);
        $repository->create([
            'merchant_id' => $merchant->id,
            'wish_id'     => $request->get('wish_id'),
        ]);

        return response()->json(['success' => true]);
    }
}
