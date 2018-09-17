<?php

namespace App\Modules\Review\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Review\Models\MerchantReview;
use App\Modules\Review\Requests\Api\CreateMerchantReviewRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MerchantReviewController extends Controller
{
    /**
     * @param CreateMerchantReviewRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Review\Exceptions\WrongCustomerIdException
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function store(CreateMerchantReviewRequest $request): JsonResponse
    {
        $orderId = $request->get('order_id');

        /** @var MerchantReview $review */
        $review = app(MerchantReview::class);
        $review->fill($request->all());
        $review->customer_id = Auth::user()->customer->id;

        $review->create($orderId);

        return response()->json(['success' => true]);
    }
}
