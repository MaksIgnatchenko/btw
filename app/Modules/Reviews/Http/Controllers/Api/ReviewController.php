<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Requests\CreateReviewRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ReviewController
 * @package App\Modules\Reviews\Http\Controllers\Api
 */
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
    /**
     * @var ProductReviewRepository
     */
    private $productReviewsRepository;


    /**
     * ReviewController constructor.
     * @param OrderRepository $orderRepository
     * @param MerchantReviewRepository $merchantReviewRepository
     * @param ProductReviewRepository $productReviewRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        MerchantReviewRepository $merchantReviewRepository,
        ProductReviewRepository $productReviewRepository
    ) {
        $this->merchantReviewRepository = $merchantReviewRepository;
        $this->orderRepository = $orderRepository;
        $this->productReviewsRepository = $productReviewRepository;
    }

    /**
     * @param Request $request
     * @param string $type
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showReviews(Request $request, string $type, int $id) : JsonResponse
    {
        switch ($type) {
            case 'merchant':
                $repository = $this->merchantReviewRepository;
                break;
            case 'product':
                $repository = $this->productReviewsRepository;
                break;
            default:
                return response()->json([
                    'success' => false,
                    'error' => "Review for $type  not found"
                ], 404);
        }

        $reviews = $repository->getActiveReviews(
            $id,
            $request->get('offset', 0)
        );

        if (null === $reviews) {
            return response()->json([
                'success' => false,
                'error' => "$type with id=$id not found"
            ], 404);
        }

        return response()->json([
            'reviews' => $reviews
        ]);
    }

    /**
     * @param CreateReviewRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateReviewRequest $request) : JsonResponse
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

        return response()->json(['success' => true]);
    }
}
