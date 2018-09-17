<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Bidding\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Bidding\Http\Requests\Api\CreateBidRequest;
use App\Modules\Bidding\Models\Bid;;
use App\Modules\Users\Models\Merchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * @param CreateBidRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function store(CreateBidRequest $request): JsonResponse
    {
        $user = Auth::user();
        /** @var Merchant $merchant */
        $merchant = $user->merchant;
        /** @var Bid $bid */
        $bid = app(Bid::class);

        $bid->fill($request->all());
        $bid->create($merchant);

        return response()->json(['success' => true]);
    }
}
