<?php

namespace App\Modules\Review\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Review\Models\ProductReview;
use App\Modules\Review\Requests\Api\CreateProductReviewRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    /**
     * @param CreateProductReviewRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Review\Exceptions\WrongCustomerIdException
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function store(CreateProductReviewRequest $request): JsonResponse
    {
        $orderId = $request->get('order_id');

        /** @var ProductReview $review */
        $review = app(ProductReview::class);
        $review->fill($request->all());
        $review->customer_id = Auth::user()->customer->id;

        $review->create($orderId);

        return response()->json(['success' => true]);
    }
}
