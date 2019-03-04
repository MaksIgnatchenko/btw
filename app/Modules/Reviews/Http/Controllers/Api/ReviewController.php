<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 14.02.2019
 */

namespace App\Modules\Reviews\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Repositories\OrderRepository;
use App\Modules\Reviews\Enums\ReviewTypesEnum;
use App\Modules\Reviews\Factories\ReviewRepositoryFactoryInterface;
use App\Modules\Reviews\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Repositories\ProductReviewRepository;
use App\Modules\Reviews\Repositories\ReviewRepositoryInterface;
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
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var ReviewRepositoryFactoryInterface
     */
    private $reviewRepositoryFactory;


    /**
     * ReviewController constructor.
     * @param OrderRepository $orderRepository
     * @param ReviewRepositoryFactoryInterface $reviewRepositoryFactory
     */
    public function __construct(
        OrderRepository $orderRepository,
        ReviewRepositoryFactoryInterface $reviewRepositoryFactory
    ) {
        $this->reviewRepositoryFactory = $reviewRepositoryFactory;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     * @param string $type
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showReviews(Request $request, string $type, $id) : JsonResponse
    {
        $reviews = $this->reviewRepositoryFactory
            ->getRepository($type)
            ->getActiveReviewsByOwnerId(
                $id,
                $request->get('offset', 0)
            );

        if (null === $reviews) {
            return response()->json([
                'success' => false,
                'error' => "$type with id=$id not found",
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

        if (null === $order) {
            return response()->json([
                'success' => false,
                'error' => "Order with id=$request->order_id not found",
            ], 404);
        }

        $this->reviewRepositoryFactory->getRepository(ReviewTypesEnum::MERCHANT)->createReview(
            $order,
            $request->merchant_rating,
            $request->merchant_comment
        );

        $this->reviewRepositoryFactory->getRepository(ReviewTypesEnum::PRODUCT)->createReview(
            $order,
            $request->product_rating,
            $request->product_comment
        );

        return response()->json(['success' => true]);
    }
}
