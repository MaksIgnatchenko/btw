<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Products\Models\Product;
use App\Modules\Reviews\Dto\ReviewDto;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Requests\CreateReviewRequest;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * @var MerchantReviewRepository
     */
    private $merchantReviewRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    private $productReviewsRepository;


    public function __construct(
        OrderRepository $orderRepository,
        MerchantReviewRepository $merchantReviewRepository,
        ProductReviewRepository $productReviewRepository
    ) {
        $this->merchantReviewRepository = $merchantReviewRepository;
        $this->orderRepository = $orderRepository;
        $this->productReviewsRepository = $productReviewRepository;
    }

    public function showMerchantReviews(Request $request, Merchant $merchant)
    {
        $reviews = $this->merchantReviewRepository->getActiveReviews(
            $merchant,
            $request->get('offset', 0)
        );

        return response()->json([
            'reviews' => $reviews
        ]);
    }

    public function showProductReviews(Request $request, Product $product)
    {
        $reviews = $this->productReviewsRepository->getActiveReviews(
            $product,
            $request->get('offset', 0)
        );

        return response()->json([
            'reviews' => $reviews
        ]);
    }

    public function create(CreateReviewRequest $request)
    {
        $order = $this->orderRepository->findCustomerOrderById(
            $request->order_id,
            Auth::user()->id
        );


        $this->merchantReviewRepository->createReview(
            $order,
            $request->merchant_rating,
            $request->merchant_comment
        );

        $this->productReviewsRepository->createReview(
            $order,
            $request->product_rating,
            $request->product_comment
        );
        $order->update(['rated' => true]);

        return response()->json(['success' => true]);
    }
}